<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Modules\Core\Models\Business;
use App\Services\Tenancy\TenantContext;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TenantMiddleware
{
    public function __construct(
        protected TenantContext $context
    ) {}

    public function handle(Request $request, Closure $next): Response
    {
        $business = $this->resolveBusiness($request);

        if ($business) {
            $this->context->setBusiness($business);

            // Set branch if passed via header or session or request parameter
            $branchId = $request->header('X-Branch-Id') 
                ?? $request->input('branch_id') 
                ?? session('current_branch_id')
                ?? $request->user()?->current_branch_id;

            if ($branchId) {
                $branch = $business->branches()->find($branchId);
                if ($branch) {
                    $this->context->setBranch($branch);
                }
            }

            // Apply business timezone and locale if user has none configured
            $timezone = $request->user()?->timezone ?? $business->default_timezone ?? config('app.timezone', 'UTC');
            config(['app.timezone' => $timezone]);
            date_default_timezone_set($timezone);

            $locale = $request->user()?->locale ?? $business->default_language ?? config('app.locale', 'en');
            app()->setLocale($locale);
        }

        return $next($request);
    }

    protected function resolveBusiness(Request $request): ?Business
    {
        // 1. Authenticated user's business
        if ($request->user() && $request->user()->business_id) {
            return Business::find($request->user()->business_id);
        }

        // 2. Request header
        $headerId = $request->header('X-Business-Id');
        if ($headerId) {
            return Business::find($headerId);
        }

        $headerSlug = $request->header('X-Business-Slug');
        if ($headerSlug) {
            return Business::where('slug', $headerSlug)->first();
        }

        // 3. Subdomain / Domain check
        $host = $request->getHost();
        $business = Business::where('domain', $host)->first();
        if ($business) {
            return $business;
        }

        $parts = explode('.', $host);
        if (count($parts) > 2) {
            $subdomain = $parts[0];
            $business = Business::where('subdomain', $subdomain)->first();
            if ($business) {
                return $business;
            }
        }

        // 4. Default business in single tenant mode
        return Business::where('status', 'active')->first();
    }
}

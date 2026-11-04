<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Facades\Module;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckModuleEnabled
{
    public function handle(Request $request, Closure $next, string $moduleKey): Response
    {
        if (!Module::enabled($moduleKey)) {
            if ($request->expectsJson() || $request->is('api/*')) {
                return response()->json([
                    'error' => "Module [{$moduleKey}] is disabled for this organization.",
                    'code' => 'MODULE_DISABLED',
                    'module' => $moduleKey,
                ], 404);
            }

            abort(404, "Module [{$moduleKey}] is not enabled for this workspace.");
        }

        return $next($request);
    }
}

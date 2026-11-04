<?php

declare(strict_types=1);

namespace App\Services\Pdf;

use ImranDev\UnicodePdf\Facades\UnicodePdf;
use ImranDev\UnicodePdf\UnicodePdfDocument;
use Throwable;

class PdfService
{
    public function loadView(string $view, array $data = []): UnicodePdfDocument
    {
        return UnicodePdf::loadView($view, $data);
    }

    public function loadHtml(string $html): UnicodePdfDocument
    {
        return UnicodePdf::loadHtml($html);
    }

    public function fake(): mixed
    {
        return UnicodePdf::fake();
    }

    public function getStatus(): array
    {
        $installed = class_exists(\ImranDev\UnicodePdf\UnicodePdfServiceProvider::class);
        $configured = config('unicode-pdf') !== null;

        return [
            'package' => 'imrandevbd/laravel-unicode-pdf',
            'name' => 'Universal Unicode PDF Engine',
            'installed' => $installed,
            'version' => 'dev-main',
            'configured' => $configured,
            'enabled' => true,
            'status' => $installed ? 'healthy' : 'error',
            'last_used' => now()->toIso8601String(),
            'message' => 'Unicode PDF ready with multilingual font fallback & RTL shaping',
            'metrics' => [
                'default_engine' => config('unicode-pdf.engine', 'native'),
                'supported_scripts' => ['Latin', 'Bengali', 'Arabic', 'Devanagari', 'CJK'],
            ],
        ];
    }
}

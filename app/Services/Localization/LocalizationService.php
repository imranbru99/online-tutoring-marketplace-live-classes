<?php

declare(strict_types=1);

namespace App\Services\Localization;

class LocalizationService
{
    public const SUPPORTED_LOCALES = [
        'en' => ['name' => 'English', 'native' => 'English', 'dir' => 'ltr'],
        'bn' => ['name' => 'Bangla', 'native' => 'বাংলা', 'dir' => 'ltr'],
        'ar' => ['name' => 'Arabic', 'native' => 'العربية', 'dir' => 'rtl'],
        'hi' => ['name' => 'Hindi', 'native' => 'हिन्दी', 'dir' => 'ltr'],
        'ur' => ['name' => 'Urdu', 'native' => 'اردو', 'dir' => 'rtl'],
        'es' => ['name' => 'Spanish', 'native' => 'Español', 'dir' => 'ltr'],
        'fr' => ['name' => 'French', 'native' => 'Français', 'dir' => 'ltr'],
        'de' => ['name' => 'German', 'native' => 'Deutsch', 'dir' => 'ltr'],
        'pt' => ['name' => 'Portuguese', 'native' => 'Português', 'dir' => 'ltr'],
        'zh' => ['name' => 'Chinese', 'native' => '中文', 'dir' => 'ltr'],
        'id' => ['name' => 'Indonesian', 'native' => 'Bahasa Indonesia', 'dir' => 'ltr'],
        'tr' => ['name' => 'Turkish', 'native' => 'Türkçe', 'dir' => 'ltr'],
    ];

    public function getSupportedLocales(): array
    {
        return self::SUPPORTED_LOCALES;
    }

    public function isRtl(?string $locale = null): bool
    {
        $loc = $locale ?? app()->getLocale();
        return (self::SUPPORTED_LOCALES[$loc]['dir'] ?? 'ltr') === 'rtl';
    }

    public function setLocale(string $locale): void
    {
        if (array_key_exists($locale, self::SUPPORTED_LOCALES)) {
            app()->setLocale($locale);
            session(['locale' => $locale]);
        }
    }
}

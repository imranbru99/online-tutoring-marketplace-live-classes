<?php

declare(strict_types=1);

namespace App\Filament\SuperAdmin\Resources;

use App\Modules\Core\Models\Business;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class BusinessResource extends Resource
{
    protected static ?string $model = Business::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';

    protected static ?string $navigationLabel = 'Businesses (Tenants)';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('name')
                ->required()
                ->maxLength(255),
            TextInput::make('slug')
                ->disabled()
                ->dehydrated(false)
                ->helperText('Universal slug auto-generated on save'),
            TextInput::make('domain')
                ->maxLength(255)
                ->placeholder('e.g. academy.com'),
            TextInput::make('subdomain')
                ->maxLength(100)
                ->placeholder('e.g. oxford'),
            TextInput::make('email')
                ->email()
                ->maxLength(255),
            TextInput::make('phone')
                ->tel()
                ->maxLength(30),
            ColorPicker::make('primary_color')
                ->default('#4f46e5'),
            Select::make('default_currency')
                ->options([
                    'USD' => 'USD ($)',
                    'BDT' => 'BDT (৳)',
                    'EUR' => 'EUR (€)',
                    'GBP' => 'GBP (£)',
                    'SAR' => 'SAR (﷼)',
                    'AED' => 'AED (د.إ)',
                ])
                ->default('USD'),
            Select::make('default_language')
                ->options([
                    'en' => 'English',
                    'bn' => 'Bangla',
                    'ar' => 'Arabic (RTL)',
                    'es' => 'Spanish',
                    'fr' => 'French',
                ])
                ->default('en'),
            TextInput::make('default_timezone')
                ->default('UTC'),
            Select::make('mode')
                ->options([
                    'single' => 'Single Business',
                    'saas' => 'Multi-Tenant SaaS',
                ])
                ->default('single'),
            Select::make('status')
                ->options([
                    'active' => 'Active',
                    'trial' => 'Trial',
                    'suspended' => 'Suspended',
                ])
                ->default('active'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('slug')->copyable(),
                TextColumn::make('domain')->searchable(),
                TextColumn::make('default_currency')->badge(),
                ColorColumn::make('primary_color'),
                TextColumn::make('mode')->badge(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'active' => 'success',
                        'trial' => 'warning',
                        'suspended' => 'danger',
                        default => 'gray',
                    }),
                TextColumn::make('created_at')->dateTime()->sortable(),
            ])
            ->actions([
                EditAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => BusinessResource\Pages\ListBusinesses::route('/'),
            'create' => BusinessResource\Pages\CreateBusiness::route('/create'),
            'edit' => BusinessResource\Pages\EditBusiness::route('/{record}/edit'),
        ];
    }
}

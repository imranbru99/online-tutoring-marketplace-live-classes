<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources;

use App\Modules\Core\Models\Branch;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class BranchResource extends Resource
{
    protected static ?string $model = Branch::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office';

    protected static ?string $navigationGroup = 'Settings & Platform';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('name')
                ->required()
                ->maxLength(255),
            TextInput::make('code')
                ->maxLength(50)
                ->placeholder('e.g. BR-DHK-01'),
            TextInput::make('email')
                ->email()
                ->maxLength(255),
            TextInput::make('phone')
                ->tel()
                ->maxLength(30),
            TextInput::make('city')
                ->maxLength(100),
            TextInput::make('country')
                ->default('BD')
                ->maxLength(100),
            TextInput::make('timezone')
                ->default('UTC')
                ->maxLength(100),
            Toggle::make('is_main')
                ->label('Main Headquarters / Flagship Campus')
                ->default(false),
            Select::make('status')
                ->options([
                    'active' => 'Active',
                    'inactive' => 'Inactive',
                ])
                ->default('active'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('code')->badge(),
                TextColumn::make('city')->searchable(),
                TextColumn::make('country')->badge(),
                IconColumn::make('is_main')->boolean()->label('Main Branch'),
                TextColumn::make('status')->badge()->color(fn ($state) => $state === 'active' ? 'success' : 'danger'),
            ])
            ->actions([
                EditAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => BranchResource\Pages\ListBranches::route('/'),
            'create' => BranchResource\Pages\CreateBranch::route('/create'),
            'edit' => BranchResource\Pages\EditBranch::route('/{record}/edit'),
        ];
    }
}

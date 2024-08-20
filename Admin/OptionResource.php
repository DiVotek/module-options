<?php

namespace  Modules\Options\Admin;

use App\Filament\Resources\TranslateResource\RelationManagers\TranslatableRelationManager;
use App\Services\Schema;
use App\Services\TableSchema;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Modules\Options\Admin\OptionResource\Pages;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationGroup;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Modules\Options\Admin\OptionResource\RelationManagers\ValuesRelationManager;
use Modules\Options\Models\Option;

class OptionResource extends Resource
{
    protected static ?string $model = Option::class;

    public static function getNavigationGroup(): ?string
    {
        return __('Catalog');
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getModelLabel(): string
    {
        return __('Option');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Options');
    }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return parent::getEloquentQuery()->withoutGlobalScopes();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('')->schema([
                    Schema::getName(),
                    Schema::getStatus(),
                    Schema::getSorting(),
                    Toggle::make('required')->label('Is Required')->default(false),
                    Select::make('default_value')->relationship('defaultValue', 'name')->label('Default Value')->nullable()->native(false),
                ])
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TableSchema::getName(),
                TableSchema::getStatus(),
                TableSchema::getSorting(),
                TableSchema::getUpdatedAt(),
                //
            ])
            ->reorderable('sorting')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        $group = RelationGroup::make('group', [
            TranslatableRelationManager::class,
            ValuesRelationManager::class,
        ]);
        return [
            $group
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOptions::route('/'),
            'create' => Pages\CreateOption::route('/create'),
            'edit' => Pages\EditOption::route('/{record}/edit'),
        ];
    }
}

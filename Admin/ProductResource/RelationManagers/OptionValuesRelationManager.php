<?php

namespace Modules\Options\Admin\ProductResource\RelationManagers;

use App\Services\Schema;
use App\Services\TableSchema;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\AttachAction;
use Filament\Tables\Table;
use Modules\Options\Models\OptionValue;

class OptionValuesRelationManager extends RelationManager
{
    protected static string $relationship = 'optionValues';

    public function form(Form $form): Form
    {
        return $form
            ->schema([]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('option.name'),
                Tables\Columns\TextColumn::make('sign'),
                TableSchema::getPrice(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\AttachAction::make()->form(fn(AttachAction $action): array => [
                    $action->getRecordSelect(),
                    ToggleButtons::make('sign')->options([
                        '+' => 'Plus',
                        '-' => 'Minus',
                    ])->inline()->default('+'),
                    Schema::getPrice(),
                ])->preloadRecordSelect(),
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
                Tables\Actions\DetachAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}

<?php

namespace Modules\Options\Admin\OptionResource\Pages;

use Modules\Options\Admin\OptionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Modules\Options\Models\OptionValue;

class EditOption extends EditRecord
{
    protected static string $resource = OptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()->after(function ($record) {
                OptionValue::query()->where('option_id', $record->id)->delete();
            }),
        ];
    }
}

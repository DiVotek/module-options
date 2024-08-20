<?php

namespace Modules\Options\Admin\OptionResource\Pages;

use Modules\Options\Admin\OptionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOptions extends ListRecords
{
    protected static string $resource = OptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

<?php

namespace Modules\Options\Admin\OptionResource\Pages;

use Modules\Options\Admin\OptionResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateOption extends CreateRecord
{
    protected static string $resource = OptionResource::class;
}

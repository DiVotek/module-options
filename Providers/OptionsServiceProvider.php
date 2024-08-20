<?php

namespace Modules\Options\Providers;

use App;
use Illuminate\Support\ServiceProvider;

class OptionsServiceProvider extends ServiceProvider
{
    protected string $moduleName = 'Options';

    public function boot(): void
    {
        $this->loadMigrations();
    }

    public function register(): void {}

    private function loadMigrations(): void
    {
        $this->loadMigrationsFrom(module_path($this->moduleName, 'Migrations'));
    }
}

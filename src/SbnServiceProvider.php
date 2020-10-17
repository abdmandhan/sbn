<?php

namespace Abdmandhan\Sbn;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class SbnServiceProvider extends ServiceProvider
{

    public function register()
    {
    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/Routes/api.php');
        $this->loadMigrationsFrom(__DIR__ . '/Database/migrations');
    }
}

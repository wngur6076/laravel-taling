<?php

namespace App\Providers;

use App\Models\DataTransferObjectMapper\DataTransferObjectMapper;
use App\Models\DataTransferObjectMapper\JsonDataTransferObjectMapper;
use App\Models\NotifyMessage\IzitoastNotifyMessage;
use App\Models\NotifyMessage\NotifyMessage;
use App\Models\NumberGenerator\ProductNumberGenerator;
use App\Models\NumberGenerator\RandomProductNumberGenerator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        $this->app->bind(DataTransferObjectMapper::class, JsonDataTransferObjectMapper::class);
        $this->app->bind(ProductNumberGenerator::class, RandomProductNumberGenerator::class);
        $this->app->bind(NotifyMessage::class, IzitoastNotifyMessage::class);
    }
}

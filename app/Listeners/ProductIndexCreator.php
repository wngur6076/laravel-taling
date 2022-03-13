<?php

namespace App\Listeners;

use App\Events\ProductAdded;
use App\Http\Services\Elasticsearch\ProductService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ProductIndexCreator
{
    use InteractsWithQueue;

    private $service;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(ProductService $service)
    {
        $this->service = $service;
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\ProductAdded  $event
     * @return void
     */
    public function handle(ProductAdded $event)
    {
        $this->service->add(
            $event->getSerialNumber(),
            $event->getName(),
            $event->getDisplayName(),
            $event->getDescription(),
            $event->getMarketName(),
            $event->getCategoryName(),
            $event->getPrice(),
            $event->getSalePrice(),
        );
    }
}

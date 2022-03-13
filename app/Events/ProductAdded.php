<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ProductAdded
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var string
     */
    private $serialNumber;
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $displayName;
    /**
     * @var string
     */
    private $description;
    /**
     * @var string
     */
    private $marketName;
    /**
     * @var string
     */
    private $categoryName;
    /**
     * @var integer
     */
    private $price;
    /**
     * @var integer
     */
    private $salePrice;

    /**
     * @param string $serialNumber
     * @param string $name
     * @param string $displayName
     * @param string $description
     * @param string $marketName
     * @param string $categoryName
     * @param int $price
     * @param int $salePrice
     */
    public function __construct(string $serialNumber, string $name, string $displayName, string $description, string $marketName, string $categoryName, int $price, int $salePrice)
    {
        $this->serialNumber = $serialNumber;
        $this->name = $name;
        $this->displayName = $displayName;
        $this->description = $description;
        $this->marketName = $marketName;
        $this->categoryName = $categoryName;
        $this->price = $price;
        $this->salePrice = $salePrice;
    }

    /**
     * @return string
     */
    public function getSerialNumber(): string
    {
        return $this->serialNumber;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDisplayName(): string
    {
        return $this->displayName;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getMarketName(): string
    {
        return $this->marketName;
    }

    /**
     * @return string
     */
    public function getCategoryName(): string
    {
        return $this->categoryName;
    }

    /**
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * @return int
     */
    public function getSalePrice(): int
    {
        return $this->salePrice;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}

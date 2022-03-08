<?php

namespace App\Requests\Product;

class StoreRequest
{
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $display_name;
    /**
     * @var string
     */
    private $description;
    /**
     * @var integer
     */
    private $price;
    /**
     * @var integer
     */
    private $sale_price;
    /**
     * @var \Illuminate\Http\UploadedFile|null
     */
    private $thumb_img;
    /**
     * @var integer
     */
    private $category_id;
    /**
     * @var integer
     */
    private $market_id;

    /**
     * @param string $name
     * @param string $display_name
     * @param string $description
     * @param int $price
     * @param int $sale_price
     * @param \Illuminate\Http\UploadedFile|null $thumb_img
     * @param int $category_id
     * @param int $market_id
     */
    public function __construct(string $name, string $display_name, string $description, int $price, int $sale_price, ?\Illuminate\Http\UploadedFile $thumb_img, int $category_id, int $market_id)
    {
        $this->name = $name;
        $this->display_name = $display_name;
        $this->description = $description;
        $this->price = $price;
        $this->sale_price = $sale_price;
        $this->thumb_img = $thumb_img;
        $this->category_id = $category_id;
        $this->market_id = $market_id;
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
        return $this->display_name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
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
        return $this->sale_price;
    }

    /**
     * @return \Illuminate\Http\UploadedFile|null
     */
    public function getThumbImg(): ?\Illuminate\Http\UploadedFile
    {
        return $this->thumb_img;
    }

    /**
     * @return int
     */
    public function getCategoryId(): int
    {
        return $this->category_id;
    }

    /**
     * @return int
     */
    public function getMarketId(): int
    {
        return $this->market_id;
    }
}

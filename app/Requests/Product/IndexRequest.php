<?php

namespace App\Requests\Product;

class IndexRequest
{
    const CATEGORY_ALL = 'all';

    /**
     * @var string|null
     */
    private $category;

    /**
     * @var string|null
     */
    private $keyword;

    /**
     * @param string|null $category
     * @param string|null $keyword
     */
    public function __construct(string $category, string $keyword)
    {
        $this->category = $category;
        $this->keyword = $keyword;
    }

    /**
     * @return string|null
     */
    public function getCategory(): ?string
    {
        return $this->category;
    }

    /**
     * @return string|null
     */
    public function getKeyword(): ?string
    {
        return $this->keyword;
    }
}

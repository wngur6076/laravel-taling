<?php

namespace App\Http\Services\Elasticsearch;

use App\Foundation\ElasticsearchClient;
use App\Requests\Product\IndexRequest;

class ProductService
{
    /**
     * @var ElasticsearchClient
     */
    private $client;

    /**
     * @param ElasticsearchClient $client
     */
    public function __construct(ElasticsearchClient $client)
    {
        $this->client = $client;
    }

    public function getQueryByCategoryName($categoryName)
    {
        return "SELECT serial_number
                FROM taling___products_product___v1
                WHERE category_name = '$categoryName'
                ORDER BY score() DESC";
    }

    public function getQueryAllProduct()
    {
        return "SELECT serial_number
                FROM taling___products_product___v1";
    }

    public function getQueryByKeyword($keyword)
    {
        return "SELECT serial_number
                FROM taling___products_product___v1
                WHERE
                (
                    MATCH(name_nori, '$keyword') OR MATCH(name_jamo, '$keyword') OR MATCH(name_chosung, '$keyword')
                    OR
                    MATCH(display_name_nori, '$keyword') OR MATCH(display_name_jamo, '$keyword') OR MATCH(display_name_chosung, '$keyword')
                    OR
                    MATCH(description_nori, '$keyword') OR MATCH(description_jamo, '$keyword') OR MATCH(description_chosung, '$keyword')
                    OR
                    MATCH(market_name_nori, '$keyword') OR MATCH(market_name_jamo, '$keyword') OR MATCH(market_name_chosung, '$keyword')
                    OR
                    MATCH(category_name_nori, '$keyword') OR MATCH(category_name_jamo, '$keyword') OR MATCH(category_name_chosung, '$keyword')
                )
                ORDER BY score() DESC";
    }

    public function getSerialNumberOfSearchedProduct(IndexRequest $request)
    {
        if ($this->hasCategory($request->getCategory())) {
            $query = $this->getQueryByCategoryName($request->getCategory());
        } else {
            $query = $this->getQueryAllProduct();
        }

        if ($request->getKeyword()) {
            $query = $this->getQueryByKeyword($request->getKeyword());
        }

        $rows = $this->executeSql($query);

        return array_merge(...$rows);
    }

    public function add(
        string $serial_number,
        string $name,
        string $displayName,
        string $description,
        string $marketName,
        string $categoryName,
        int $price,
        int $salePrice,
    ): array
    {
        $params = [
            'index' => 'taling___products_product___v1',
            'id' => sprintf('product:%s', $serial_number),
            'body' => [
                'serial_number' => $serial_number,
                'name' => $name,
                'display_name' => $displayName,
                'description' => $description,
                'market_name' => $marketName,
                'category_name' => $categoryName,
                'price' => $price,
                'sale_price' => $salePrice,
            ]
        ];

        return $this->client->client()->index($params);
    }

    public function executeSql($query)
    {
        return $this->client->client()->sql()->query([
            'body' => [ 'query' => $query ]
        ])['rows'];
    }

    public function hasCategory($category)
    {
        return $category && $category !== IndexRequest::CATEGORY_ALL;
    }
}

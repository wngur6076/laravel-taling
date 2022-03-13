<?php

namespace Database\Seeders;

use App\Events\ProductAdded;
use App\Models\Category;
use App\Models\Market;
use App\Models\Product;
use App\Models\ProductReal;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Events\Dispatcher;

class ProductSeeder extends Seeder
{
    private $dispatcher;

    private $option1Name = ['small', 'medium', 'large'];
    private $option1DisplayName = ['S', 'M', 'L'];
    private $option2Name = ['red', 'green', 'blue', 'pink', 'wine', 'black'];
    private $option2DisplayName = ['레드', '그린', '블루', '핑크', '와인', '블랙'];

    public function __construct(Dispatcher $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    public function run()
    {
        Category::factory(5)->create()->each(function ($category) {
            $category->products()->saveMany(
                Product::factory(rand(10, 40))->make([
                    'user_id' => rand(1, User::count()),
                    'market_id' => rand(1, Market::count())
                ])
            )->each(function ($product) {
                $this->dispatcher->dispatch(
                    new ProductAdded(
                        $product->serial_number,
                        $product->name,
                        $product->display_name,
                        $product->description,
                        $product->market->name,
                        $product->category->name,
                        $product->price,
                        $product->sale_price,
                    )
                );

                foreach (range(0, rand(1, 5)) as $i) {
                    $sizeIndex = rand(0, 2);
                    ProductReal::factory()->create([
                        'product_id' => $product->id,
                        'option_1_name' => $this->option1Name[$sizeIndex],
                        'option_1_display_name' => $this->option1DisplayName[$sizeIndex],
                        'option_2_name' => $this->option2Name[$i],
                        'option_2_display_name' => $this->option2DisplayName[$i]
                    ]);
                }
            });
        });

    }
}

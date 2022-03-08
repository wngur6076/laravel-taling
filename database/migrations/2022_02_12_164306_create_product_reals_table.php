<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductRealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_reals', function (Blueprint $table) {
            $table->id();
            $table->string('option_1_type', 10)->default('SIZE');
            $table->string('option_1_name', 50);
            $table->string('option_1_display_name', 50);
            $table->string('option_2_type', 10)->default('COLOR');
            $table->string('option_2_name', 50);
            $table->string('option_2_display_name', 50);
            $table->string('option_3_type', 10)->nullable();
            $table->string('option_3_name', 50)->nullable();
            $table->string('option_3_display_name', 50)->nullable();
            $table->boolean('is_sold_out')->default(false);
            $table->boolean('is_hidden')->default(false);
            $table->integer('add_price')->default(0);
            $table->unsignedInteger('stock_quantity')->default(0);
            $table->unsignedBigInteger('product_id');
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->unique(['product_id', 'option_1_name', 'option_2_name', 'option_3_name'], 'option_name_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_reals');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('shop_products', static function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id');

            $table->string('title');
            $table->string('slug');
            $table->text('excerpt');
            $table->text('description');
            $table->float('price')->default(0);
            $table->string('image')->nullable();
            $table->boolean('status')->default(true);
            $table->integer('views')->default(0);

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('shop_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('shop_products');
    }
}

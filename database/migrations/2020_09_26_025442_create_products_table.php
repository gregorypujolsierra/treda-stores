<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'products',
            function (Blueprint $table) {
                $table->id();
                $table->string('name', 128);
                $table->string('sku', 64)->unique();
                $table->string('description', 512);
                $table->unsignedBigInteger('price');
                $table->unsignedBigInteger('store_id')->nullable();
                $table->string('image', 128);
                $table->timestamps();

                $table->foreign('store_id')->references('id')->on('stores')
                    ->onDelete('set null')
                    ->onUpdate('cascade');
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}

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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->text("name");
            $table->string("category_name")->nullable();
            $table->string("description")->nullable();
            $table->string("link")->nullable();
            $table->string("prefix")->nullable();
            $table->string("size_image")->nullable();
            $table->string("main_image")->nullable();
            $table->string("size_chart_image")->nullable();
            $table->string("replace_size_image")->nullable();
            $table->text("image")->nullable();
            $table->timestamps();
        });
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

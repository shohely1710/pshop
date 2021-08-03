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
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('short_description')->nullable();
            $table->text('description');
            $table->decimal('regular_price');
            $table->decimal('sale_price')->nullable();
            $table->string('SKU');  //SKU is Stock Keeping Unit
            $table->enum('stock_status', ['instock', 'outstock']); //enum is a symbolic name for a set of values
            $table->boolean('featured')->default(false);
            $table->unsignedInteger('quantity')->default(10);  //Unsigned integers are integers that can only hold non-negative whole numbers.
            $table->string('image')->nullable();
            $table->text('images')->nullable();
            $table->bigInteger('category_id')->unsigned()->nullable();
            $table->timestamps();
 
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade'); //onDelete('cascade') means that when the row is deleted, it will delete all it's references and attached data too.
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

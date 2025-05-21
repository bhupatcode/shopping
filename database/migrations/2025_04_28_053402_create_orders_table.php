<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID column
            $table->unsignedBigInteger('user_id'); // Foreign key for the user who placed the order
            $table->unsignedBigInteger('product_id'); // Foreign key for the product in the order
            $table->integer('quantity'); // Quantity of the product ordered
            $table->decimal('total_price', 10, 2); // Total price for the order
            $table->enum('status', ['pending', 'completed','processing', 'cancelled', 'shipped'])->default('pending'); // Order status
            $table->timestamps(); // created_at and updated_at timestamps

            // Foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_details', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->integer('invoice_id');
            $table->integer('category_id');
            $table->integer('product_id');
            $table->double('selling_qty');
            $table->double('unit_price');
            $table->double('selling_price');
            $table->double('status')->default('0')->comment('0=Pending,1=Approved');
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
        Schema::dropIfExists('invoice_details');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
          $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('phone');
            $table->enum('emirate', ['Abu Dhabi', 'Dubai','Sharjah','Ajman','Umm Al Quwain','Fujairah','Ras Al Khaimah']);
            $table->string('image');
            $table->string('image1');
            $table->string('address');
            $table->enum('cash', ['paid', 'unpaid','CCM']);
            $table->string('amount');
            $table->enum('prepare', ['10m', '15m','20m']);
            $table->string('note');
            $table->enum('vehicle', ['car', 'bike']);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}

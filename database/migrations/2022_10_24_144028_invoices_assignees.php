<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InvoicesAssignees extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    Schema::create('invoices_assignees', function (Blueprint $table) {
           $table->id();
            $table->unsignedBigInteger('invoice_id');
            $table->unsignedBigInteger('assignee_id');
            $table->foreign('assignee_id')->references('id')->on('users')->onDelete('cascade');
                    $table->foreign('invoice_id')->references('id')->on('invoices')->onDelete('cascade');
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
           Schema::dropIfExists('invoices_assignees');
    }
}

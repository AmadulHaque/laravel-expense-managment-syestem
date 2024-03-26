<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('image')->nullable();
            $table->string('quantity')->nullable();
            $table->string('amount')->nullable();
            $table->string('note')->nullable();
            $table->date('date')->nullable();
            $table->integer('created_by')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('purchases');
    }
};

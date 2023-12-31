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
        Schema::create('biblio', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');
            $table->string('responsibility')->nullable();
            $table->string('edition')->nullable();
            $table->string('spec_detail')->nullable();
            $table->string('gmd')->nullable();
            $table->string('content_type')->nullable();
            $table->string('media_type')->nullable();
            $table->string('carrier_type')->nullable();
            $table->date('date')->nullable();
            $table->string('isbnissn')->unique()->nullable();
            $table->string('place')->nullable();
            $table->string('description')->nullable();
            $table->string('title_series')->nullable();
            $table->string('classification')->nullable();
            $table->string('call_number')->unique()->nullable();
            $table->string('language')->nullable();
            $table->string('abstract')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
            $table->softDeletes();  //buat softdelete
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('biblio');
    }
};

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
            $table->string('edition');
            $table->string('spec_detail');
            $table->string('gmd');
            $table->string('content_type')->nullable();
            $table->string('carrier_type')->nullable();
            $table->date('date')->nullable();
            $table->string('isbnissn')->unique();
            $table->string('place');
            $table->string('description');
            $table->string('title_series');
            $table->string('classification');
            $table->string('call_number')->unique();
            $table->string('subject');
            $table->string('language');
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

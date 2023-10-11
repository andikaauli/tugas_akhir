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
        Schema::create('members', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('nim')->unique();
            $table->enum('gender',['Laki-laki','Perempuan']);
            $table->dateTime('birth_date');
            $table->string('address');
            $table->string('email')->unique();
            $table->string('instituion');
            $table->string('image');
            $table->string('phone');
            $table->softDeletes();  //buat softdelete
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
        Schema::dropIfExists('members');
    }
};

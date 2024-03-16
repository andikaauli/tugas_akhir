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
        Schema::table('biblio', function (Blueprint $table) {
            $table->foreignid('author_id')->nullable()->constrained('author')->restrictOnDelete();
            $table->foreignid('coll_type_id')->nullable()->constrained('coll_type')->restrictOnDelete();
            $table->foreignid('publisher_id')->nullable()->constrained('publisher')->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('biblio', function (Blueprint $table) {
            //
        });
    }
};

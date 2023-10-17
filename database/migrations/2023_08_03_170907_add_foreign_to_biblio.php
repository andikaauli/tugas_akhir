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
            $table->foreignid('author_id')->nullable()->constrained('author')->nullOnDelete();
            $table->foreignid('coll_type_id')->constrained('coll_type');
            $table->foreignid('publisher_id')->constrained('publisher');
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

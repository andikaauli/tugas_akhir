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
        Schema::create('loan', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->dateTime('loan_date');
            $table->dateTime('due_date');
            $table->dateTime('return_date')->nullable();
            $table->string('loan_status')->nullable();
            $table->string('return_status')->nullable();
            $table->string('late_charge')->nullable();
            $table->string('day_overdue')->nullable();
            $table->timestamps();
            $table->foreignUuid('eksemplar_id')->constrained('eksemplar')->restrictOnDelete();
            $table->foreignUuid('member_id')->constrained('members')->restrictOnDelete(); //member gabisa dihapus ketika masih ada peminjaman
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loan');
    }
};

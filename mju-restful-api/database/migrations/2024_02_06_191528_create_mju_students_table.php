<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mju_students', function (Blueprint $table) {
            $table->string('student_code')->primary();
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('first_name_en');
            $table->string('last_name_en')->nullable();
            $table->unsignedBigInteger('major_id');
            $table->string('idcard');
            $table->date('birthdate')->nullable();
            $table->char('gender', 1)->nullable();
            $table->string('address');
            $table->string('phone');
            $table->string('email')->unique();
            $table->timestamps();

            $table->foreign('major_id')->references('major_id')->on('majors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mju_students', function (Blueprint $table) {
            $table->dropForeign(['major_id']);
        });

        Schema::dropIfExists('mju_students');
    }
};

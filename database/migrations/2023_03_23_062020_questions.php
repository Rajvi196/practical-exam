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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('exam_id')->nullable();
            $table->text('title');
            $table->text('description');
            $table->float('marks',4,2);
            $table->string('image',100)->nullable();
            $table->enum('status', ['0', '1'])->default('1');
            $table->timestamps();

            $table->foreign('exam_id')->references('id')->on('exam_details')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};

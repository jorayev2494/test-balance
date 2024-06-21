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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();

            $table->string('title')->nullable();
            $table->float('income')->nullable()->comment('доход');
            $table->float('cost')->nullable()->comment('расходы');
            $table->float('amount')->nullable()->comment('сумма');
            $table->bigInteger('author_id')->index();
            $table->foreign('author_id')->on('users')->references('id')->noActionOnDelete()->noActionOnUpdate();
            $table->softDeletes();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};

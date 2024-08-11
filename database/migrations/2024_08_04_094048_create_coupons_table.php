<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique()->nullable();
            $table->text('description')->nullable();
            $table->decimal('discount')->nullable();
            $table->enum('type', ['fixed', 'percent'])->nullable();
            $table->timestamp('start_at')->nullable();
            $table->timestamp('expired_at')->nullable();

        });
    }

    public function down()
    {
        Schema::dropIfExists('coupons');
    }
};

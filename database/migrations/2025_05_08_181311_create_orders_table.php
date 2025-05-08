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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id')
                ->nullable()
                ->constrained('stores')
                ->nullOnDelete();
            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();
            $table->string('number')
                ->unique();
            $table->enum('status', ['pending', 'processing', 'delivering', 'completed'])
                ->default('pending');
            $table->enum('payment_method', ['bank_card', 'cash'])
                ->default('bank_card');
            $table->enum('payment_status', ['pending', 'succeeded', 'failed'])
                ->default('pending');
            $table->decimal('total', 10, 2)->nullable();
            $table->char('currency', 3)->default('USD');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};

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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id')->constrained('stores')->cascadeOnDelete();
            $table->foreignId('categoryId')->nullable()->constrained('categories')->nullOnDelete();
            $table->string('title')->unique();
            $table->string('small_description');
            $table->text('description');
            $table->string('image');
            $table->string('slug');
            $table->double('price')->default(0);
            $table->double('compare_price')->nullable();
            $table->json('options')->nullable();
            $table->float('rating')->nullable();
            $table->boolean('featured')->default(0);
            $table->enum('status', ['active', 'inactive', 'archived', 'draft']);
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_links')->nullable();
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
        Schema::dropIfExists('products');
    }
};

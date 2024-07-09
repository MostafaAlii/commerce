<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique()->nullable();
            $table->text('description')->nullable();
            $table->double('price');
            $table->unsignedBigInteger('quantity')->default(0);
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->boolean('featured')->default(false);
            $table->boolean('status')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('products');
    }
};

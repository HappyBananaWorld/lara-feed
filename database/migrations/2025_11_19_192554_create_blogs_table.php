<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('title');
            $table->text('description');
            $table->string('slug');
            $table->string('url');
            $table->enum('status',array_column(\App\BlogStatusEnum::cases(),'value'));
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};

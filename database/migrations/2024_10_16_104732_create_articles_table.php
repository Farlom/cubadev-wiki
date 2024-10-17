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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique()->comment('Название статьи');
            $table->longText('text')->fulltext('idx_article_text')->comment('Содержание статьи');
            $table->string('url')->comment('Cсылка на статью');
            $table->float('size')->storedAs('round(length(text) / 1024, 2)')->comment('Размер статьи');
            $table->integer('count')->comment('Количество слов');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};

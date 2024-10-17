<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $id
 * @property string $title Название
 * @property string $text Текст
 * @property string $url Ссылка на статью
 * @property float $size Размер статьи
 * @property int $count Количество слов
 */
class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'title',
        'text',
        'url',
        'count',
    ];

    public function words(): BelongsToMany
    {
        return $this->belongsToMany(Word::class, 'article_word', 'article_id', 'word_id')->withPivot('count')->orderByPivot('count', 'DESC');
    }

    private function split()
    {

    }
}

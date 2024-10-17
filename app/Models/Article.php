<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Хранимые статьи
 * @property int $id
 * @property string $title Название
 * @property string $text Текст
 * @property string $url Ссылка на статью
 * @property float $size Размер статьи
 * @property int $count Количество слов
 * @property $created_at
 * @property $updated_at
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

    /**
     * @return BelongsToMany
     */
    public function words(): BelongsToMany
    {
        return $this->belongsToMany(Word::class, 'article_word', 'article_id', 'word_id')->withPivot('count')->orderByPivot('count', 'DESC');
    }
}

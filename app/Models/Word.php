<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Уникальные слова
 * @property int $id
 * @property string $word
 */
class Word extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['word'];

    /**
     * @return BelongsToMany
     */
    public function articles(): BelongsToMany
    {
        return $this->belongsToMany(Article::class, 'article_word', 'word_id', 'article_id')->withPivot('count')->orderByPivot('count', 'DESC');
    }
}

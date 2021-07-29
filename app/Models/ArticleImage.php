<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ArticleImage
 *
 * @property string     $image
 * @property int        $article_id
 * @property int        $id
 *
 * @package App\Models
 */
class ArticleImage extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'article_id',
        'image',
    ];
}

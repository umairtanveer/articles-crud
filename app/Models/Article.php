<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class Article
 *
 * @property int        $id
 * @property int        $user_id
 * @property string     $title
 * @property string     $detail
 *
 * @package App\Models
 */
class Article extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'title',
        'detail'
    ];

    /**
     * Return article image
     *
     * @return HasOne
     */
    public function image(): HasOne
    {
        return $this->hasOne(ArticleImage::class);
    }

    /**
     * Return article image
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Return validation rules for form input
     *
     * @return string[]
     */
    public static function rules($isImageRequired = true): array
    {
        $rules = [
            'title'     => 'required|max:100|min:3',
            'detail'    => 'required|max:1000|min:10'
        ];

        if ($isImageRequired) {
            $rules += [
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ];
        }

        return $rules;
    }
}

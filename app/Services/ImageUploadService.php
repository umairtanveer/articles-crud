<?php

namespace App\Services;

use App\Models\Article;
use App\Models\ArticleImage;

/**
 * Class ImageUploadService
 * @package App\Services
 */
class ImageUploadService
{
    /**
     * Save article image in disk and create entry in DB
     *
     * @param $article
     * @param $image
     * @return string
     */
    public static function saveArticleImage($article, $image): string
    {
        $destinationPath    = config('storage-paths.article_images') . DIRECTORY_SEPARATOR;
        $profileImage       = date('YmdHis') . '.' . $image->getClientOriginalExtension();

        $image->move($destinationPath, $profileImage);

        $imagePath          = $destinationPath . $profileImage;

        ArticleImage::query()->create([
            'article_id'    => $article->id,
            'image'         => $imagePath,
        ]);

        return $imagePath;
   }
}

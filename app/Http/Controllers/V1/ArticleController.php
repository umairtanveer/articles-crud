<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\ArticleCollection;
use App\Http\Resources\V1\ArticleResource;
use App\Models\Article;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Response;

class ArticleController extends Controller
{
    /**
     * Return array of articles
     *
     * @param Request $request
     * @return ArticleCollection
     */
    public function get(Request $request): ArticleCollection
    {
        $articles = Article::select('id', 'title', 'detail', 'created_at');

        if ($userId = $request->get('user_id')) {
            $articles->where('user_id', '=', $userId);
        }

        if ($dateFrom = $request->get('created_from')) {
            $articles->where('created_at', '>=', $dateFrom);
        }

        if ($dateTo = $request->get('created_to')) {
            $articles->where('created_at', '<=', $dateTo);
        }

        $perPage = $request->get('per_page', 15);
        $articles = $articles->paginate($perPage);

        return new ArticleCollection($articles);
    }

    /**
     * Return array of articles
     *
     * @param $id
     * @return JsonResponse|ArticleResource
     */
    public function show($id)
    {
        $article = Article::find($id);

        if (is_null($article)) {
            return response()->json([
                'code'      => Response::HTTP_BAD_REQUEST,
                'message'   => "Article does not exists against ID# $id"
            ]);
        }

        return new ArticleResource($article);
    }
}

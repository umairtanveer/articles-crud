<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Services\ImageUploadService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;

class ArticleController extends Controller
{
    /**
     * Display a listing of the articles resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $articles = Article::latest()->simplePaginate(15);
        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        // Validation rules for form
        $request->validate(Article::rules(true));

        // Save article data
        try {
            $article = Article::query()->create([
                'user_id'   => Auth::user()->id,
                'title'     => $request->get('title'),
                'detail'    => $request->get('detail')
            ]);
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Unable to create article. Please contact our support.');
        }

        // Upload image to system if found
        if ($image = $request->file('image')) {
            try {
                ImageUploadService::saveArticleImage($article, $image);
            } catch (Exception $ex) {
                return redirect()->back()->with('error',
                    'Unable to upload images at the moment. Please contact our support.');
            }
        }

        return redirect()->route('articles.index')
            ->with('success', 'Article has been created successfully.');
    }

    /**
     * Display the specified article by ID.
     *
     * @param Article $article
     * @return Application|Factory|View
     */
    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified article.
     *
     * @param Article $article
     * @return Application|Factory|View
     */
    public function edit(Article $article)
    {
        return view('articles.edit', compact('article'));
    }

    /**
     * Update the specified article in storage.
     *
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        // Validation rules for form
        $request->validate(Article::rules(false));

        // Find and update article detail
        try {
            $article = Article::find($id);
            $article->forceFill([
                'title'     => $request->get('title'),
                'detail'    => $request->get('detail')
            ])->update();
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Unable to update article. Please contact our support.');
        }

        if ($image = $request->file('image')) {
            try {
                unset($article->image->image);
                $article->image()->delete();

                ImageUploadService::saveArticleImage($article, $image);
            } catch (Exception $ex) {
                return redirect()->back()->with('error',
                    'Unable to upload images at the moment. Please contact our support.');
            }
        }

        return redirect()->route('articles.index')
            ->with('success', 'Article has been updated successfully');
    }

    /**
     * Remove the specified article from storage.
     *
     * @param Article $article
     * @return RedirectResponse
     */
    public function destroy(Article $article): RedirectResponse
    {
        try {
            unset($article->image->image);
            $article->image()->delete();
            $article->delete();
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Unable to delete article. Please contact our support.');
        }

        return redirect()->route('articles.index')
            ->with('success', 'Article has been deleted successfully');
    }
}

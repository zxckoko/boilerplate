<?php

namespace App\Http\Controllers;

use App\DataTables\ArticlesDataTable;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Article;

use Yajra\DataTables\Facades\DataTables;

use Str;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ArticlesDataTable $dataTable)
    {
        // $articles = Article
        //    ::orderBy('updated_at', 'desc')
        //    ->paginate(10, ['id', 'title', 'head', 'body']);

        // return $dataTable->render('backend.articles.index');

        $title = Article::$pageHeader;

        return $dataTable->render('backend.articles.index')->with('title', $title);
    }

    public function ajax()
    {
        $draw = request()->draw;
        $columnId = request()->order[0]['column'];
        $direction = request()->order[0]['dir'];
        $orderBy = request()->columns[$columnId]['data'];

        return DataTables::eloquent(Article::query())
            ->only(['id','title', 'head', 'body', 'action'])
            ->addColumn('action', function () {
                return view('articles.action');
            })
            ->editColumn('id', function($model) {
                return Str::of($model->id)->padLeft(6, 0);
            })
            ->editColumn('title', function($model) {
                return Str::of($model->title)->limit(32);
            })
            ->editColumn('head', function($model) {
                return Str::of($model->head)->limit(128);
            })
            ->editColumn('body', function($model) {
                return Str::of($model->body)->limit(128);
            })
            ->order(function ($q) use ($draw, $orderBy, $direction) {
                if ((int) $draw === 1) return $q->orderBy('updated_at', 'desc');

                return $q->orderBy($orderBy, $direction);
            })
            ->toJson();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArticleRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        return $article;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArticleRequest $request, Article $article)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        //
    }
}

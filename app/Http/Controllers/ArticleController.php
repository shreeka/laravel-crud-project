<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    public function index(){
        $articles = DB::table('articles')->paginate(3);

        return view('articles.index',['articles'=> $articles]);
    }

    public function create(){
        return view('articles.create');
    }

    public function store(Request $request){
        $request->validate([
            'topic' => 'required',
            'description' => 'required',
            'category' => 'required',
        ]);

        Article::create($request->all());

        return redirect()->route('articles.index')
            ->with('success','Article created successfully.');
    }

    public function show(Article $article){
        return view('articles.show',compact('article'));
    }

    public function edit(Article $article){
        return view('articles.edit',compact('article'));
    }

    public function update(Request $request, Article $article){
        $request->validate([
            'topic' => 'required',
            'description' => 'required',
            'category' => 'required',
        ]);

        $article->update($request->all());

        return redirect()->route('articles.index')
            ->with('success','Article updated successfully.');
    }

    public function destroy(Article $article){
        $article->delete();

        return redirect()->route('articles.index')
            ->with('success','Article deleted successfully.');
    }

}

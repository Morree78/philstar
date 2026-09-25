<?php
namespace App\Http\Controllers;
use App\Models\Article;
use Illuminate\Http\Request;
class NewsController {
    public function index(Request $request) {
        $validated=$request->validate(['q'=>'nullable|string|max:200','category'=>'nullable|string|max:50','page'=>'nullable|integer|min:1']);
        $q=trim($validated['q']??'');$category=$validated['category']??'';
        $query=Article::query();
        if($q!==''){$query->where(function($query)use($q){$query->where('title','like','%'.$q.'%')->orWhere('excerpt','like','%'.$q.'%')->orWhere('author','like','%'.$q.'%');});}
        if($category!==''){$query->where('category',$category);}
        return view('news.index',['articles'=>$query->orderByDesc('published_at')->orderBy('id')->paginate(12)->withQueryString(),'categories'=>Article::select('category')->distinct()->orderBy('category')->pluck('category'),'q'=>$q,'category'=>$category]);
    }
    public function show(Article $article) { return view('news.show',compact('article')); }
}

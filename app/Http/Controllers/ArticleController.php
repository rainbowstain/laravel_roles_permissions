<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ArticleController extends Controller implements HasMiddleware
{
 
    public static function middleware(): array
    {
        return [
            new Middleware('permission:view articles', only: ['index']),
            new Middleware('permission:edit articles', only: ['edit']),
            new Middleware('permission:create articles', only: ['create']),
            new Middleware('permission:delete articles', only: ['destroy']),
        ];
    }


  public function index(){
    $articles = Article::latest()->paginate(8);
    return view('articles.list', [
        'articles' => $articles
    ]);
  }

    public function create(){
        return view('articles.create');
    }

    public function store(Request $request){
    
        $validator = Validator::make($request->all(), [
        'title' => 'required|string|min:3',
        'author' => 'required|string|min:3',
        'text' => 'required|string|min:3',
    
    ]);

   if ($validator->passes()) {

    $article = new Article();
    $article->title = $request->title;
    $article->text = $request->text;
    $article->author = $request->author;
    $article->save();

    return redirect()->route('articles.index')->with('success', 'Articulo creado correctamente' );
   } else {
    return redirect()->route('articles.create')->withInput()->withErrors($validator);
   }
        
    }

     public function edit ( string $id){

        $article = Article::findOrFail($id);
        return view('articles.edit', [
            'article' => $article
        ]);
    }

    public function update(Request $request, string $id){    

        $article = Article::findOrFail($id);


        $validator = Validator::make($request->all(), [ 
            'title' => 'required|string|min:3',
            'author' => 'required|string|min:3',

        ]);

        if ($validator->passes()) {

            $article->title = $request->title;
            $article->text = $request->text;
            $article->author = $request->author;
            $article->save();

            return redirect()->route('articles.index')->with('success', 'Articulo actualizado correctamente' );
        } else {
            return redirect()->route('articles.edit', $id)->withInput()->withErrors($validator);
        }
     

     }

     public function destroy(Request $request)
     {
        $article = Article::find($request->id);

    if ($article == null) {
        session()->flash('error', 'Articulo no encontrado');
        return response()->json([
            'status' => false,
            'message' => 'Articulo no encontrado'
        ]);
    }

    $article->delete(); 

   session()->flash('success', 'Articulo eliminado correctamente');
   return response()->json([
    'status' => true,
    'message' => 'Articulo eliminado correctamente'
   ]);
}
}

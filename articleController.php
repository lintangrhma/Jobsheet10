<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class articleController extends Controller
{
   

    public function article ($page){
  
   return view('article', ['page'=>$page]);
   public function add() 
   { 
       return view('addarticle'); 
   } 
   public function create(Request $request) 
   { 
       Article::create([ 
           'title' => $request->title, 
           'content' => $request->content, 
           'featured_image' => $request->image 
       ]); 
       return redirect('/manage');     } 
       protected $fillable = ['title','content','featured_image']; 
       public function edit($id) 
    { 
        $article = Article::find($id); 
        return view('editarticle',['article'=>$article]);     } 
        <form action="/article/update/{{$article->id}}" method="post"> 
        {{csrf_field()}} 
        <input type="hidden" name="id" value="{{$article-
>id}}"></br> 
        <div class="form-group"> 
            <label for="title">Judul</label>           
                  <input type="text" class="form-control" 
required="required" name="title" value="{{$article->title}}"></br> 
        </div> 
        <div class="form-group"> 
            <label for="content">Content</label>               
              <input type="text" class="form-control" required="required" name="content" value="{{$article-
>content}}">
</br> 
        </div> 
        <div class="form-group"> 
            <label for="image">Feature Image</label>          
                   <input type="text" class="form-control" required="required" name="image" value="{{$article-
>featured_image}}"></br> 
        </div> 
        <button type="submit" name="edit" class="btn btnprimary float-right">Ubah Data</button> 
        public function update($id, Request $request) 
        { 
            $article = Article::find($id); 
            $article->title = $request->title; 
            $article->content = $request->content; 
            $article->featured_image = $request->image; 
            $article->save(); S
            return redirect('/manage');     } 
            <a href="article/delete/{{ $a->id }}" class="badge badgedanger">Hapus</a> 
            public function delete($id) 
    { 
        $article = Article::find($id); 
        $article->delete();       
          return redirect('/manage'); 
    } 
    
    public function __construct() 
    { 
        $this->middleware(function($request, $next){ 
            if(Gate::allows('manage-articles')) return $next($request);      
               abort(403, 'Anda tidak memiliki cukup hak akses'); 
        }); 
    } 
    <li class="nav-item {{ Route::is('manage') ? 'active' : '' }}"> 
   @can('manage-articles') 
   <a class="nav-link" href="{{ route('manage') }}">Kelola</a> 
   @endcan 

   public function create(Request $request)
{
 if($request->file('image')){
 $image_name = $request->file('image')->store('images','public');
 }
 Article::create([
 'title' => $request->title,
 'content' => $request->content,
 'featured_image' => $image_name,
 ]);
 return redirect('/manage');
}

public function update($id, Request $request)
{
 $article = Article::find($id);
 $article->title = $request->title;
 $article->content = $request->content;
 public function cetak_pdf(){
    $article = Article::all();
    $pdf = PDF::loadview('articles_pdf',['article'=>$article]);
    return $pdf->stream();
   }
   

 if($article->featured_image && 
 file_exists(storage_path('app/public/' . $article->featured_image)))
 {
 \Storage::delete('public/'.$article->featured_image);
 }
 $image_name = $request->file('image')->store('images', 'public');
 $article->featured_image = $image_name;
 $article->save();
 return redirect('/manage');
}

   

 
  
}
}



<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;
use App\Post;
use App\PostInformation;
use App\Tag;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Auth;


class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::check()){
            $columns = [
                '#','Titolo','Categoria','Descrizione','Tags','Aggiorna','Cancella'
            ];
        }else{
            $columns = [
                '#','Titolo','Categoria','Descrizione','Tags'
            ];
        }
        $posts = Post::paginate();

        //debug
        /* foreach($posts as $post){

            if(!isset($post->postInformstion)){
                //creo un oggetto post di default in caso ci siano incosistenze nel database
                $tmpPostInfo = new PostInformation();
                $tmpPostInfo->description = "Not found";
                $tmpPostInfo->slug = 'NONE';
                $tmpPostInfo->post_id = $post->id;
                $tmpPostInfo->save();
                //è una toppa in caso di problemi, ma non risolve il problema
                $post->postinformation = $tmpPostInfo;
            }
        } */


        return view('posts.index', compact('posts','columns'));
        
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
            $categories = Category::all();
            $tags = Tag::all();
        
        

        return view('posts.create', compact('categories','tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //creo le due variabili per tutte le tabelle
        $newPost = new Post();
        $newPostInformation = new PostInformation();

        //fornisco i dati agli oggetti/colonne per tutte le variabili
        $newPost->title = $request['title_in'];
        $newPost->author = $request['author_in'];
        $newPost->category_id = $request['category_in'];

        $newPostInformation->description = $request['description_in'];
        $newPostInformation->slug = Str::of($request['title_in'])->slug('-');

        $newPost->save();
        
        //salvataggio relationship tra le due variabili quindi colonne
        $newPost->postInformation()->save($newPostInformation);

        $newPost->tags()->attach($request['tags_in']);
        

    
        return view('posts.success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);

        return view('posts.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        $categories = Category::all();
        $tags = Tag::all();

        return view('posts.edit',compact('post','categories','tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        

        $updatingPost = Post::find($id);

        $postInformationId = $updatingPost->postInformation->id;

        $updatingPostInformation = PostInformation::find($postInformationId);

        $updatingPost->title = $request['title_in'];

        $updatingPost->author = $request['author_in'];

        $updatingPost->category_id = $request['category_in'];

        $updatingPostInformation->description = $request['description_in'];

        $updatingPostInformation->slug = Str::of($request['title_in'])->slug('-');

        $updatingPost->save();

        $updatingPost->postInformation()->save($updatingPostInformation);//salvataggio relationship
        /* dd($updatingPost->tags->name); */
        $updatingPost->tags()->attach($request['tags_in'])->diff();//BUG devo controllare che non sovrascriva quelli già salvati

        return view('posts.success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {   
       /*  dd($post->tags()); */
        
        $post->tags()->detach();

        $post->postInformation()->delete();

        $post->delete();
        
        return redirect()->route('posts.index');
    }
}

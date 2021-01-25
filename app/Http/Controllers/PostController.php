<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;
use App\Post;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage; 

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->get();

        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        
        $data['slug'] = Str::slug($data['title'], '-');
        
        //validazione
        $request->validate($this->ruleValidation());
        // dd($data);

        if(!empty($data['path_image'])){
            $data['path_image'] = Storage::disk('public')->put('image', $data['path_image'] );
        }

        // dd($data);

        //salvataggio nel DB
        $newPost = new Post();
        $newPost->fill($data);

        $saved = $newPost->save();
        if($saved){
            return redirect()->route('posts.index');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = Post::where('slug', $slug)->first();
        // dd($post);
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $post = Post::where('slug', $slug)->first();
        return view('posts.edit', compact('post'));
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
        $data = $request->all();

        $post = Post::find($id);

        //validazione
        $request->validate($this->ruleValidation());

        //cambio slug
        $data['slug'] = Str::slug($data['title'], '-');

        //immagini
        if(!empty($data['path_image'])){
            if(!empty($post->path_image)){
                Storage::disk('public')->delete($post->path_image);
            }
            $data['path_image'] = Storage::disk('public')->put('image', $data['path_image'] );
        };
        $updated = $post->update($data);
        if($updated){
            return redirect()->route('posts.show', $post->slug);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function ruleValidation(){
        return [
            'title' => 'required',
            'content' => 'required',
            'path_image' => 'image'
        ];
    }
}
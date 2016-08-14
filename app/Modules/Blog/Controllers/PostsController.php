<?php

namespace App\Modules\Blog\Controllers;

use App\Modules\Blog\Services\PostService;
use App\Modules\Blog\Requests\PostsRequest;
use App\Http\Controllers\Controller;
use App\Modules\Blog\Models\Post;

class PostsController extends Controller
{
    private $service;
    
    function __construct(PostService $service) {
        $this->service = $service;
    }

    public function index() {
        $posts = Post::all();
        
        return view('Blog::posts.index', compact('posts'));
    }
    
    public function details(Post $post) {
        $tags = '';        
        foreach ($post->tags()->lists('name') as $value) {            
            $tags .= $value . ', ';
        }
        $tags = (substr($tags, -2) == ', ') ? trim(substr($tags, 0, (strlen($tags) - 2))) : $tags;

        return view('Blog::posts.details', compact('post', 'tags'));
    }
    
    public function create() {
        return view('Blog::posts.create');
    }
    
    public function store(PostsRequest $request) {        
        $this->service->store($request);
        return redirect()->back();
    }
    
    public function edit(Post $post) {
        //format tags view
        $tags = '';        
        foreach ($post->tags()->lists('name') as $value) {            
            $tags .= $value . ', ';
        }
        $tags = (substr($tags, -2) == ', ') ? trim(substr($tags, 0, (strlen($tags) - 2))) : $tags;
        
        return view('Blog::posts.edit', compact('post', 'tags'));
    }
    
    public function update(PostsRequest $request) {
        $this->service->update($request);
        return redirect()->back();
    }
    
    public function remove(Post $post) {
        $this->service->remove($post);
        return redirect()->route('admin.posts.index');
    }
    
    public function status(Post $post) {
        $this->service->status($post);
        return redirect()->back();
    }
}

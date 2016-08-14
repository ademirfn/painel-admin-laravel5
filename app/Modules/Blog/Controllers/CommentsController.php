<?php

namespace App\Modules\Blog\Controllers;

use App\Modules\Blog\Requests\CommentRequest;
use App\Http\Controllers\Controller;
use App\Modules\Blog\Services\CommentService;
use App\Modules\Blog\Models\Comment;

class CommentsController extends Controller
{
    private $service;
    
    function __construct(CommentService $service) {
        $this->service = $service;
    }

    public function index() {
        $posts = Comment::all();
        
        return view('admin.comments.index', compact('comments'));
    }
    
    public function details(Comment $comment) {       
        return view('admin.comments.details', compact('comment'));
    }
    
    public function create() {
        return view('admin.comments.create');
    }
    
    public function store(PostsRequest $request) {
        $this->service->store($request);
        return redirect()->back();
    }
    
    public function edit(Comment $comment) {        
        return view('admin.comments.edit', compact('comment'));
    }
    
    public function update(CommentRequest $request) {
        $this->service->update($request);
        return redirect()->back();
    }
    
    public function remove(Comment $comment) {
        $this->service->remove($comment);
        return redirect()->route('admin.comments.index');
    }
    
    public function status(Comment $comment) {
        $this->service->status($comment);
        return redirect()->back();
    }
}

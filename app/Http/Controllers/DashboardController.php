<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Newsletter;
use App\Modules\Blog\Models\Post;

class DashboardController extends Controller 
{
    public function index() {       

        //EMAILS CADASTRADOS
        $newsletter = Newsletter::all();
        
        //POSTS CADASTRADOS
        $posts = Post::all();


        return view('admin.dashboard', compact('newsletter', 'posts'));
    }

}

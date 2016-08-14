<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Newsletter;
use Illuminate\Support\Facades\Session;

class NewsletterController extends Controller
{
    protected $newsletter;

    public function __construct(Newsletter $newsletter)
    {
        $this->newsletter = $newsletter;
    }

    public function index()
    {
        $emails = $this->newsletter->get(); 
        return view('admin.newsletter.index', compact('emails'));
    }

    public function status(Newsletter $newsletter)
    {      
        if ($newsletter->active == 'Y'){
            $newsletter->update(['active'=>'N']);
        }else{
            $newsletter->update(['active'=>'Y']);
        }         

        Session::flash('success', 'Newsletter atualizado com sucesso!');
        return redirect()->route('admin.newsletter.index');
    }
}

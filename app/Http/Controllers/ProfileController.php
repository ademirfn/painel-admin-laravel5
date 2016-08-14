<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use App\Http\Requests\UserRequest;

class ProfileController extends Controller
{
    private $service;
    
    function __construct(UserService $service) 
    {
        $this->service = $service;
    }
    
    public function edit() 
    {
        $user = \Auth::user();
        return view('admin.profile.edit', compact('user'));
    }
    
    public function update(UserRequest $request) 
    {
        $this->service->update($request);
        return redirect()->back();
    }

}

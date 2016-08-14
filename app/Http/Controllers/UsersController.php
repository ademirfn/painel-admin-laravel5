<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Services\UserService;

class UsersController extends Controller {

    protected $user;
    protected $service;

    public function __construct(User $user, UserService $service) {
        $this->user = $user;
        $this->service = $service;        
    }

    public function index() {
        $users = $this->user->admin()->get();        
        return view('admin.users.index', compact('users'));
    }

    public function details(User $user) {
        return view('admin.users.details', compact('user'));
    }

    public function create() {
        return view('admin.users.create');
    }

    public function store(UserRequest $request) 
    {
        $this->service->store($request);
        return redirect()->back();
    }

    public function edit(User $user) 
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(UserRequest $request) 
    {  
        $this->service->update($request);
        return redirect()->back();
    }

    public function remove(User $user) {
        $this->service->delete($user);
        return redirect()->back();
    }

    public function status(User $user) {
        $this->service->status($user);
        return redirect()->back();
    }    

}

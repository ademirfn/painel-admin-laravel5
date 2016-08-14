<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Session;

class UserService {

    private $user;

    function __construct(User $user) 
    {
        $this->user = $user;
    }

    public function store($request) 
    {    
        $this->user->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => $request->role_id
        ]);
        Session::flash('success', 'Usuário cadastrado com sucesso!');
    }

    public function update($request) 
    {
        $user = $this->user->find($request->id); 
        $user->update($request->all());
        Session::flash('success', 'Usuário atualizado com sucesso!');
    }

    public function status($user) 
    {
        $parms['active'] = 'Y';
        if ($user->active == 'Y') {
            $parms['active'] = 'N';
        }
        $user->update($parms);
        Session::flash('success', 'Usuário atualizado com sucesso!');
    }

    public function delete($user) 
    {
        if ($user->where('role_id', 2)->count() == 1) {
            \Session::flash('info', 'Não é possível excluir o último usuário administrador!');
            return redirect()->route('admin.users.index');
        }

        $user->delete();

        Session::flash('success', 'Usuário excluído com sucesso!');

        if ($user->id == \Auth::user()->id) {
            \Auth::logout();
            return redirect()->route('auth.login');
        }
    }

}

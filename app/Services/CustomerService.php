<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Session;

class CustomerService {

    private $user;

    function __construct(User $user) {
        $this->user = $user;
    }

    public function store($request) {
        
    }

    public function update($request) {
       
    }

    public function status($user) {
        $parms['active'] = 'Y';
        if ($user->active == 'Y') {
            $parms['active'] = 'N';
        }
        $user->update($parms);

        Session::flash('success', 'Usuário atualizado com sucesso!');
    }

    public function delete($user) {
        if (count($user->orders()) > 0){
            Session::flash('danger', 'Usuário não pode ser excluído, existem registros relacionados');
            return redirect()->route('admin.customers.index');
        }
        $user->delete();
        Session::flash('success', 'Usuário excluído com sucesso!');        
    }

}

@extends('admin')

@section('title', 'Usuários')

@section('actions')
    <div class="clearfix">
        <b class="btn pull-left" style="cursor: default;">
            usuários
        </b>
        <div class="pull-right">
                      
        </div>
    </div>
@endsection

@section('content')

    <table class="table table-user-information">
        <tbody>
        <tr>
            <td style="width: 20%"><b>Nível:</b></td>
            <td>{{ role($user->role_id) }}</td>
        </tr>
        <tr>
            <td style="width: 20%"><b>Nome:</b></td>
            <td>{{ ucfirst($user->name) }}</td>
        </tr>
        <tr>
            <td style="width: 20%"><b>Email:</b></td>
            <td>{{ $user->email }}</td>
        </tr>
        <tr>
            <td style="width: 20%"><b>Status:</b></td>
            <td>{!! status($user->active) !!}</td>
        </tr>
        <tr>
            <td style="width: 20%"><b>Cadastro:</b></td>
            <td>{{ dateformat($user->created_at) }}</td>
        </tr>
        </tbody>
    </table>

    @include(
        'admin.partial.actions',
        ['model'=>$user,
        'route'=>[
            'index'=>'root.users.index',
            'edit'=>'root.users.edit',
            'status'=>'root.users.status',
            'remove'=>'root.users.remove'
            ]
        ])

@stop

@push('scripts')
    
@endpush
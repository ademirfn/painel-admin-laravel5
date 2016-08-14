@extends('admin')

@section('title', 'Usuários')

@section('actions')
    <div class="clearfix">
        <b class="btn pull-left" style="cursor: default;">
            usuários
        </b>
        <div class="pull-right">
            <a href="{{ route('root.users.create') }}" class="btn btn-primary">
                <i class="fa fa-plus-circle fa-fw"></i> adicionar novo
            </a>            
        </div>
    </div>
@endsection

@section('content')

    <div class="row">
        @foreach($users as $user)
            <div class=" col-md-6">
                <div class="well">
                    <p>{!! status($user->active) !!} 
                    <a href="{{ route('root.users.details', ['id'=>$user->id]) }}"                       
                       class="btn btn-default btn-xs pull-right">
                        <i class="fa fa-cogs fa-fw"></i> gerenciar
                    </a>
                    </p>
                    <p><b>Nome:</b> {{ ucfirst($user->name) }}</p>                    
                    <p><b>Email:</b> {{ $user->email }}</p>
                </div>
            </div>
        @endforeach
    </div>


@stop

@push('scripts')
    
@endpush
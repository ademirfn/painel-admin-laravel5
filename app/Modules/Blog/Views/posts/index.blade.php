@extends('admin')

@section('styles')
<!-- DataTables CSS -->
<link href="{{ url('/') }}/plugin/datatables/dataTables.bootstrap.css" rel="stylesheet">

@endsection

@section('title', 'Artigos')

@section('actions')
<div class="clearfix">
    <b class="btn pull-left" style="cursor: default;">
        artigos
    </b>
    <div class="pull-right">
        <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">
            <i class="fa fa-plus-circle fa-fw"></i> adicionar novo
        </a>            
    </div>
</div>
@endsection

@section('content')

<div class="dataTable_wrapper">
    <div class="table-responsive">
        <table class="table table-striped table-hover" id="table">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Subtítulo</th>
                    <th>Cadastro</th>
                    <th>Status</th>                    
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($posts as $post)
                <tr>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->subtitle }}</td>                    
                    <td>{{ dateformat($post->created_at, 'd/m/Y') }}</td>
                    <td>{!! status($post->active) !!}</td>                    
                    <td style="width:1%; text-align:center;">
                        <a href="{{ route('admin.posts.details', ['id'=>$post->id]) }}"                           
                           class="btn btn-default btn-xs">
                            <i class="fa fa-cogs fa-fw"></i> gerenciar
                        </a>
                    </td>                    
                </tr>
                @endforeach        
            </tbody>
        </table>
    </div>
</div>


@stop

@push('scripts')
<!-- DataTables Plugin JavaScript -->
<script src="{{ url('/') }}/plugin/datatables/jquery.dataTables.min.js"></script>    
<script src="{{ url('/') }}/plugin/datatables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
<script src="{{ url('/') }}/plugin/datatables/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" charset="utf-8" async defer>
$(function () {
    var parms = {
        search: true,
        bLength: true,
        iDisplayLength: 10,
        aaSorting: 2,
        orderBy: 'desc',
        mColumnsExport: [0, 1, 2, 3]
    }

    app.table(parms);
});
</script>    
@endpush
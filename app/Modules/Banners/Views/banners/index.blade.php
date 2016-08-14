@extends('admin')

@section('styles')
    <!-- DataTables CSS -->
    <link href="{{ url('/') }}/plugin/datatables/dataTables.bootstrap.css" rel="stylesheet">
    <link href="{{ url('/') }}/plugin/shadowbox/shadowbox.css" rel="stylesheet">
    
@endsection

@section('title', 'Banners')

@section('actions')
    <div class="clearfix">
        <b class="btn pull-left" style="cursor: default;">
            banners
        </b>
        <div class="pull-right">
            <a href="{{ route('admin.banners.create') }}" class="btn btn-primary">
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
                        <th>Imagem</th>
                        <th>Título</th>
                        <th>Cadastro</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($banners as $banner)
                    <tr>
                        <td>
                        <a href="{{ url('/uploads') . '/' . $banner->image }}" rel='shadowbox'>
                            <img alt="banner" src="{{ url('/timthumb.php?src=/uploads/' . $banner->image . '&w=120&h=40&q=100$zc=1') }}" width="120" class="img-circle img-responsive img-thumbnail">
                        </a>
                        </td>
                        <td>{{ $banner->title }}</td>
                        <td>{{ dateformat($banner->created_at) }}</td>
                        <td>{!! status($banner->active) !!}</td>
                        <td style="width:1%; text-align:center;">
                            <a href="{{ route('admin.banners.details', ['id'=>$banner->id]) }}" 
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
    <script src="{{ url('/') }}/plugin/shadowbox/shadowbox.js"></script>
    <script type="text/javascript" charset="utf-8" async defer>
        $(function(){
            var parms = {
                search: true,
                bLength: true,
                iDisplayLength: 25,
                aaSorting: 1,
                orderBy: 'desc',
                mColumnsExport: [0,1,2]
            }

            app.table(parms);
            app.tooltip();
            app.shadowbox();
        })
    </script>
@endpush
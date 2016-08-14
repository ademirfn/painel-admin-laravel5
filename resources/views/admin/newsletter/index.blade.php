@extends('admin')

@section('styles')
    <!-- DataTables CSS -->
    <link href="{{ url('/') }}/plugin/datatables/dataTables.bootstrap.css" rel="stylesheet">
    
@endsection

@section('title', 'Newsletter')

@section('actions')
    <div class="clearfix">
        <b class="btn pull-left" style="cursor: default;">
            newsletter
        </b>
        <div class="pull-right">
                     
        </div>
    </div>
@endsection

@section('content')
<div class="dataTable_wrapper">
    <div class="table-responsive">
        <table class="table table-striped table-hover" id="table">
            <thead>
                <tr>                    
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Cadastro</th>                    
                    <th>Status</th>                
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($emails as $news)
                <tr>                    
                    <td>{{ $news->name }}</td>                    
                    <td>{{ $news->email }}</td>                    
                    <td>{{ dateformat($news->created_at, 'd/m/Y H:i:s') }}hs</td>
                    <td>{!! newsletter($news->active) !!}</td>
                    <td style="width:1%; text-align:center;">
                        <a href="{{ route('admin.newsletter.status', ['id'=>$news->id]) }}"                                                      
                           class="btn btn-default btn-xs">    
                           @if($news->active == 'N')
                                <i class="fa fa-plus-circle fa-fw"></i> ativar
                           @else
                                <i class="fa fa-minus-circle fa-fw"></i> desativar
                           @endif 
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
        $(function(){
            var parms = {
                search: true,
                bLength: true,
                iDisplayLength: 10,
                aaSorting: 1,
                orderBy: 'desc',
                mColumnsExport: [0,1]
            }

            app.table(parms);
            app.tooltip()
        })
    </script>
@endpush
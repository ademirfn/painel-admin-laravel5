@extends('admin')

@section('title', 'Dahboard')

@section('actions')
<div class="clearfix">
    <b class="btn pull-left" style="cursor: default;">
        dashboard
    </b>    
</div>
@endsection

@section('content')

<div class="row">    

    <div class="col-lg-3 col-md-6">
        <div class="panel panel-warning">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-envelope fa-4x"></i>
                    </div>
                    <div class="col-xs-9 text-right">                            
                        <div>Emails cadastrados</div>
                    </div>
                </div>
            </div>            
            <div class="panel-footer text-warning">
                <span class="pull-left">total</span>
                <span class="pull-right">{{ count($newsletter) }}</span>
                <div class="clearfix"></div>
            </div>            
        </div>
    </div>
    
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-success">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-flag fa-4x"></i>
                    </div>
                    <div class="col-xs-9 text-right">                            
                        <div>Artigos cadastrados</div>
                    </div>
                </div>
            </div>            
            <div class="panel-footer text-warning">
                <span class="pull-left">total</span>
                <span class="pull-right">{{ count($posts) }}</span>
                <div class="clearfix"></div>
            </div>            
        </div>
    </div>
    
</div>


@stop

@push('scripts')
<script type="text/javascript">

</script>
@endpush
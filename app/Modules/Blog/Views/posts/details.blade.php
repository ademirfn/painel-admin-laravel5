@extends('admin')

@section('title', 'Artigos')

@push('styles')
<link href="{{ url('/') }}/plugin/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
<link href="{{ url('/') }}/plugin/shadowbox/shadowbox.css" rel="stylesheet">
@endpush


@section('actions')
<div class="clearfix">
    <b class="btn pull-left" style="cursor: default;">
        artigos
    </b>
    <div class="pull-right">

    </div>
</div>
@endsection

@section('content')

<div class="row">
    <div class="col-md-3 col-lg-3 " align="center">
        <img alt="artigo" src="{{ url('/timthumb.php?src=/uploads/' . $post->image . '&w=400&h=400&q=100$zc=1') }}" class="img-circle img-responsive">
    </div>

    <div class=" col-md-9 col-lg-9 ">
        <table class="table table-user-information">
            <tbody>
                <tr>
                    <td><b>Status:</b></td>
                    <td>{!! status($post->active) !!}</td>
                </tr>
                <tr>
                    <td><b>Título:</b></td>
                    <td>{{ $post->title }}</td>
                </tr>
                <tr>
                    <td><b>Subtítulo:</b></td>
                    <td>{{ $post->subtitle }}</td>
                </tr>    
                <tr>
                    <td><b>Tags:</b></td>
                    <td>{{ $tags }}</td>
                </tr> 
                <tr>
                    <td><b>Cadastro:</b></td>
                    <td>{{ dateformat($post->created_at) }}</td>
                </tr>
                <tr>
                    <td><b>Conteúdo:</b></td>
                    <td>{!! $post->content !!}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@include(
'admin.partial.actions',
['model'=>$post,
'route'=>[
'index'=>'admin.posts.index',
'edit'=>'admin.posts.edit',
'status'=>'admin.posts.status',
'remove'=>'admin.posts.remove'
]
])


@stop

@push('scripts')
<script>
$(function () {    
    
});
</script>
@endpush
@extends('admin')

@section('title', 'Banners')

@section('actions')
    <div class="clearfix">
        <b class="btn pull-left" style="cursor: default;">
            banners
        </b>
        <div class="pull-right">
                      
        </div>
    </div>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-3 col-lg-3 " align="center">
            <img alt="banner" src="{{ url('/timthumb.php?src=/uploads/' . $banner->image . '&w=400&h=400&q=100$zc=1') }}" class="img-circle img-responsive">
        </div>

        <div class=" col-md-9 col-lg-9 ">
            <table class="table table-user-information">
                <tbody>
                <tr>
                    <td><b>Status:</b></td>
                    <td>{!! status($banner->active) !!}</td>
                </tr>
                <tr>
                    <td><b>Título:</b></td>
                    <td>{{ $banner->title }}</td>
                </tr>
                <tr>
                    <td><b>Subtítulo:</b></td>
                    <td>{{ $banner->subtitle }}</td>
                </tr>
                <tr>
                    <td><b>Descrição:</b></td>
                    <td>{{ $banner->description }}</td>
                </tr>
                <tr>
                    <td><b>Link:</b></td>
                    <td>{{ $banner->link }}</td>
                </tr>
                <tr>
                    <td><b>Cadastro:</b></td>
                    <td>{{ dateformat($banner->created_at) }}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    @include(
        'admin.partial.actions',
        ['model'=>$banner,
        'route'=>[
            'index'=>'admin.banners.index',
            'edit'=>'admin.banners.edit',
            'status'=>'admin.banners.status',
            'remove'=>'admin.banners.remove'
            ]
        ])

@stop

@push('scripts')

    <script type="text/javascript" charset="utf-8" async defer>
        $(function(){
            app.tooltip();
        })
    </script>
    
@endpush
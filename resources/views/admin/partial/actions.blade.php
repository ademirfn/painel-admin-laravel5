<div class="row">

    <div class="col-xs-12 col-md-3">
        <a href="{{ route($route['index']) }}" class="btn btn-default btn-block">
            <i class="fa fa-list fa-fw"></i> listar todos
        </a>
        <br>
    </div>
    <div class="col-xs-12 col-md-3">
        @if ($model->active == 'Y')
            <a href="{{ route($route['status'], ['id'=>$model->id]) }}" class="btn btn-warning btn-block">
                <i class="fa fa-thumbs-o-down fa-fw"></i> desativar
            </a>
        @else
            <a href="{{ route($route['status'], ['id'=>$model->id]) }}" class="btn btn-success btn-block">
                <i class="fa fa-thumbs-o-up fa-fw"></i> ativar
            </a>
        @endif
        <br>
    </div>
    <div class="col-xs-12 col-md-3">
        <a href="{{ route($route['edit'], ['id'=>$model->id]) }}" class="btn btn-primary btn-block">
            <i class="fa fa-edit fa-fw"></i> editar
        </a>
        <br>
    </div>
    <div class="col-xs-12 col-md-3">
        <a href="javascript:;"
           data-toggle="modal" data-target="#myModal"           
           class="btn btn-danger btn-block">
            <i class="fa fa-trash-o fa-fw"></i> excluir
        </a>
        <br>
    </div>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title text-warning"><i class="fa fa-exclamation-triangle fa-fw"></i> Atenção! Rotina de exclusão.</h4>
      </div>
      <div class="modal-body">
        <p>Deseja realmente excluir o registro <b>{{$model->name}}</b> do sistema?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">
            <i class="fa fa-times-circle fa-fw"></i> cancelar
        </button>
        <a href="{{ route($route['remove'], ['id'=>$model->id]) }}" class="btn btn-success">
            <i class="fa fa-check-circle fa-fw"></i> confirmar exclusão
        </a>
      </div>
    </div>

  </div>
</div>
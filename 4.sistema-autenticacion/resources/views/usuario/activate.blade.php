<div class="modal fade" id="modal-toggle-{{$reg->id}}" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel">
    <div class="modal-dialog">
        <div class="modal-content {{$reg->activo ? 'bg-warning' : 'bg-success'}}">
            <form action="{{route('usuarios.toggle', $reg->id)}}" method="post">
                @csrf
                @method('PATCH')
                <div class="modal-header">
                    <h4 class="modal-title">{{$reg->activo ? 'Desactivar ' : 'Activar '}} registro</h4>
                    </button>
                </div>
                <div class="modal-body">
                    ¿Usted desea {{$reg->activo ? 'desactivar ' : 'activar '}} el registro {{$reg->name}} ?
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-light" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-outline-light">{{$reg->activo ? 'Desactivar ' : 'Activar '}}</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

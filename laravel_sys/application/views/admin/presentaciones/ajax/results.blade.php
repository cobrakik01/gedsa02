@layout('admin.presentaciones.ajax.main')

@section('menu_albums')
    @parent
@endsection

@section('menu_items_albums')
    @parent
@endsection

@section('contenido_albums')
    <h3>Nueva Presentación</h3>
    <table align="center" border="0" width="100%">
        <tr>
            <td width="10%">
                {{Form::label('nombre', 'Nombre')}}
            </td>
            <td width="90%">
                {{Form::text('nombre', '', array('style'=>'width: 98%;'))}}
            </td>
        </tr>
    </table>
    
    <h4>{{$titulo}}</h4>
    <div style="font-size: 12px; color: #66cc00; position: relative; top: -20px;">No se muestran los álbumes vacíos</div>
    
    <div id="albums-result-ajax">
        <?php if($albums->total > 0): ?>
        <table id="albums-ajax" class="tresult" align="center" width="100%">
                <?php foreach ($albums->results as $album): ?>
                    <?php if(!$album->vacio()): ?>
                        <tr id="{{$album->id}}" style="cursor: pointer;" title="Da clic para visualizar las fotos del álbum">
                            <td>
                                {{$album->id}} - {{$album->nombre}}
                            </td>
                            <td>
                                {{$album->descripcion}}
                            </td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <div class="message">No se encontro ningun álbum</div>
        <?php endif; ?>
    </div>
    <script>
        $(document).ready(function(){
            $("#albums-ajax tr").click(function() {
                var idAlbum = $(this).attr("id");
                cbk("#albums-ajax").album.verFotosDeAlbum(idAlbum);
            });
        });
    </script>
@endsection
@layout('admin.presentaciones.main')

@section('menu_albums')
    @parent
@endsection

@section('menu_items_albums')
    @parent
@endsection

@section('contenido_albums')
    <h3>
        Nueva presentación
    </h3>
    <table width="100%" border="0">
        <tr>
            <td width="233px">
                {{Form::label('nombre_presentacion', 'Nombre de la nueva presentación')}}
            </td>
            <td width="500px">
                {{Form::text('nombre_presentacion')}}
            </td>
            <td>
                <button id="btnNuevaPresentacion">Crear Presentación</button>
            </td>
        </tr>
    </table>
    
    <div id="content-ajax-presentacion">
        @if($albumes->total > 0)
        <div class="message" style="margin-bottom: 30px;">
            Solo se presentaran los álbumes con fotos
        </div>

        <table class="tresult" align="center" width="100%">
            <tr>
                <th hidden="true">
                    Id
                </th>
                <th width="200px">
                    Nombre
                </th>
                <th>
                    Descripción
                </th>
            </tr>
            @foreach($albumes->results as $album)
            @if(!$album->vacio())
            <tr style="cursor: pointer;">
                <td hidden="true">
                    {{$album->id}}
                </td>
                <td>
                    {{$album->nombre}}
                </td>
                <td>
                    {{$album->descripcion ? $album->descripcion : "sin descripcion"}}
                </td>
            </tr>
            @endif
            @endforeach
        </table>
        <table align="center">
            <tr>
                <td>
                    {{$albumes->links()}}
                </td>
            </tr>
        </table>
        @else
        <div class="message">
            <h3>
                Sin Albumes
            </h3>
            <p>
                Aún no puedes crear presentaciones sin antes haber creado al menos un álbum.
                Puedes crear tu primer álbum dando clic {{HTML::link('admin/albumes/nuevo','aquí')}} o dirigete a la sección de <strong>Administrar Álbums</strong> posteriormente da clic en la opción <strong>Nuevo álbum</strong>
            </p>
        </div>
        @endif
        <script type="text/javascript">
            $(document).ready(function(){
                $("table.tresult tr").click(function(){
                    cbk.album.open(this);
                });
                $("#btnNuevaPresentacion").click(function(e){
                    e.preventDefault();
                    cbk.presentacion.nuevo($("input[type='text']").val());
                });
            });
        </script>
    </div>
@endsection
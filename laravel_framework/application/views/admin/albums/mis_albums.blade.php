@layout('admin.albums.main')

@section('menu_albums')
    @parent
@endsection

@section('menu_items_albums')
    @parent
@endsection

@section('contenido_albums')
    <h3>Mis Albums</h3>
    @if($albums->results)
    <table class="tresult" align="center" width='100%'>
        <tr>
            <th>
                ID
            </th>
            <th>
                Nombre del album
            </th>
            <th>
                Fecha de creacion
            </th>
            <th>
                Ultima edición
            </th>
            <th>
                Direccion
            </th>
            <th>
                Accion
            </th>
        </tr>
        @foreach($albums->results as $album)
        @if($album->num_fotos() > 0)
        <tr>
            <td>
                {{$album->id}}
            </td>
            <td>
                {{HTML::link('admin/albumes/ver_fotos/' . AlbumController::toDir($album) ,$album->nombre, array('title'=>'Click para ver las fotos del Album'))}}
            </td>
            <td>
                {{$album->created_at}}
            </td>
            <td>
                {{$album->updated_at}}
            </td>
            <td>
                {{$album->url}}
            </td>
            <td align="center">
                {{HTML::link('admin/albumes/eliminar/' . AlbumController::toDir($album),'Eliminar')}}
            </td>
        </tr>
        @else
        <tr class="warning" title="Álbum vacío">
            <td>
                {{$album->id}}
            </td>
            <td>
                {{HTML::link('admin/albumes/ver_fotos/' . $album->get_dir() ,$album->nombre, array('title'=>'Click para ver las fotos del Album'))}}
            </td>
            <td>
                {{$album->created_at}}
            </td>
            <td>
                {{$album->updated_at}}
            </td>
            <td>
                {{$album->url}}
            </td>
            <td align="center">
                {{HTML::link('admin/albumes/eliminar/' . AlbumController::toDir($album),'Eliminar')}}
            </td>
        </tr>
        @endif
        @endforeach
    </table>
    <table align="center">
        <tr>
            <td>
                {{$albums->links()}}
            </td>
        </tr>
    </table>
    @else
    <div class="message">
        <div class="title-message">Aún no tienes álbumes.</div>
        <div>Puedes crear tu primer álbum dando clic {{HTML::link('admin/albumes/nuevo', 'aquí')}} o dando clic en la opción "nuevo" del menú de arriba</div>
    </div>
    @endif
@endsection
@layout('admin.albums.main')

@section('menu_albums')
@parent
@endsection

@section('menu_items_albums')
@parent
@endsection

@section('contenido_albums')
<h3>Buscar Album</h3>
{{Form::open('admin/albumes/buscar_album','GET')}}
<table align="center" style="margin-bottom:  20px;">
    <tr>
        <th align="center">
            {{Form::label('buscar','Palabra clave')}}
        </th>
        <th align="center">
            {{Form::label('filtro','Filtro')}}
        </th>
        <th align="center">
            Orden
        </th>
        <th align="center">
            Resultados por pagina
        </th>
        <th>

        </th>
    </tr>
    <tr>
        <td align="center">
            {{Form::text('buscar', Input::old('buscar'), array('style'=>'margin-right: 200px;'))}}
        </td>
        <td align="center">
            <select name="filtro">
                <option value="0">Por Id</option>
                <option value="1">Por Nombre</option>
                <option value="2">Por Fecha (aaaa-mm-dd)</option>
                <option value="3">Por Autor</option>
            </select>
            <!-- {{Form::select('filtro', array('Por Id', 'Por Fecha'), array(0, 1))}} -->
        </td>
        <td align="center">
            <select name="orden">
                <option value="desc">Desendente</option>
                <option value="asc">Ascendente</option>
            </select>
        </td>
        <td align="center">
            <select name="resultados">
                <option value="10">10</option>
                <option value="15">15</option>
                <option value="30">30</option>
                <option value="50">50</option>
            </select>
        </td>
        <td>
            {{Form::submit('Buscar')}}
        </td>
    </tr>
</table>
{{Form::close()}}
@if($errors->first('errores'))
<div class="message">
    {{$errors->first('errores')}}
</div>
@elseif(isset($albums))
<table class="tresult" align='center' width='100%'>
    <tr>
        <th>
            ID
        </th>
        <th>
            Nombre del album
        </th>
        <th>
            Autor
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
                {{HTML::link('admin/administradores/ver/' . base64_encode($album->administrador()->id) ,$album->administrador()->nombre, array('title'=>'Click para ver la informacion del Administador'))}}
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
                {{HTML::link('admin/albumes/ver_fotos/' . AlbumController::toDir($album) ,$album->nombre, array('title'=>'Click para ver las fotos del Album'))}}
            </td>
            <td>
                {{HTML::link('admin/albumes/ver/' . base64_encode($album->administrador()->id) ,$album->administrador()->nombre, array('title'=>'Click para ver la informacion del Administador'))}}
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
                {{HTML::link('admin/albumes/eliminar/' . $album->get_dir(),'Eliminar')}}
            </td>
        </tr>
        @endif
    @endforeach
</table>
{{$albums->appends(array('buscar'=>Input::get('buscar'),'filtro'=>Input::get('filtro'),'orden'=>Input::get('orden'),'resultados'=>Input::get('resultados')))->links()}}
@else
<div class="message" style="text-align: justify;">
    <h2> Recomendaciones </h2>
    Escribe alguna palabra en el campo <strong>Palabra clave</strong> con la cual se buscaran los álbumes, posteriormente selecciona un filtro para ser más específicos en la búsqueda.<br />
    Puedes dejar en blanco el campo <strong>Palabra clave</strong> para mostrar todos los resultados.
</div>
@endif
@endsection
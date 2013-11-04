@layout('admin.albums.main')

@section('menu_albums')
    @parent
@endsection

@section('menu_items_albums')
    @parent
@endsection

@section('contenido_albums')
<h3>Cambiar nombre y/o descripción.</h3>
{{Form::open('admin/albumes/cambiar_nombre_descripcion','POST')}}
<table align='center'>
    <tr>
        <td>
            {{Form::label('nombre','Nombre')}}
        </td>
        <td>
            {{Form::text('nombre', (Input::old('nombre')) ? Input::old('nombre') : $album->nombre)}}
        </td>
    </tr>
    <tr>
        <td colspan="2" align="center">
            {{Form::label('descripcion','Descripcion')}}
        </td>
    </tr>
    <tr>
        <td colspan="2" align="center">
            {{Form::textarea('descripcion', (Input::old('descripcion')) ? Input::old('descripcion') : $album->descripcion, array('rows'=>'5', 'cols'=>'30'))}}
        </td>
    </tr>
    <tr>
        <td colspan="2" align="center">
            {{Form::submit('Cambiar nombre y/o descripción')}}
        </td>
    </tr>
</table>
{{Form::hidden('nombre_anterior','')}}
@if($errors->first('errores'))
    <div class="warning">
        {{ $errors->first('errores') }}
    </div>
@endif
{{ Form::hidden('id', $album->id) }}
{{Form::close()}}
@endsection
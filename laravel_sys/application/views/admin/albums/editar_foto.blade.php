@layout('admin.albums.main')

@section('menu_albums')
    @parent
@endsection

@section('menu_items_albums')
    @parent
@endsection

@section('contenido_albums')
<h3><a href="#" onclick="javascript:history.back()">< Regresar</a> Editar Foto: {{$foto->nombre}}</h3>
<div style="text-align: center;">
    {{HTML::image($foto->url, 'onclick', array('width'=>'850'))}}
</div>
{{Form::open()}}
<table align='center'>
    <tr>
        <td>
            {{Form::label('nombre','Nombre')}}
        </td>
        <td>
            {{Form::text('nombre', (Input::old('nombre')) ? Input::old('nombre') : $foto->getSimpleName())}}
        </td>
    </tr>
    <tr>
        <td colspan="2" align="center">
            {{Form::label('descripcion','Descripcion')}}
        </td>
    </tr>
    <tr>
        <td colspan="2" align="center">
            {{Form::textarea('descripcion', (Input::old('descripcion')) ? Input::old('descripcion') : $foto->descripcion, array('rows'=>'5', 'cols'=>'30'))}}
        </td>
    </tr>
    <tr>
        <td colspan="2" align="center">
            {{Form::submit('Actualizar informacion del álbum')}}
        </td>
    </tr>
</table>
{{ Form::hidden('id', $foto->id) }}
@if($errors->first('errores'))
    <div class="warning">
        {{ $errors->first('errores') }}
    </div>
@endif
{{Form::close()}}
@endsection
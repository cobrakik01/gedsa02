@layout('admin.albums.main')

@section('menu_albums')
    @parent
@endsection

@section('menu_items_albums')
    @parent
@endsection

@section('contenido_albums')
<h3>Nuevo Album</h3>
{{Form::open()}}
<table align='center'>
    <tr>
        <td>
            {{Form::label('nombre','Nombre')}}
        </td>
        <td>
            {{Form::text('nombre', Input::old('nombre'))}}
        </td>
        <td>
            {{$errors->first('nombre')}}
        </td>
    </tr>
    <tr>
        <td colspan="2" align="center">
            {{Form::label('descripcion','Descripcion')}}
        </td>
    </tr>
    <tr>
        <td colspan="2" align="center">
            {{Form::textarea('descripcion', '', array('rows'=>'5', 'cols'=>'30'))}}
        </td>
    </tr>
    <tr>
        <td colspan="2" align="center">
            {{Form::submit('Crear Album')}}
        </td>
    </tr>
</table>
@if($errors->first('errores'))
<div class="warning">
    {{$errors->first('errores')}}
</div>
@endif
{{Form::close()}}
@endsection
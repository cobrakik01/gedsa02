@layout('admin.main')

@section('menu')
@endsection

@section('contenido')
{{ HTML::span('Inicio de Sesion', array('style' => 'font-size: 20px;')) }}
{{ Form::open() }}
<table align="center" style="width: 320px;">
    <tr>
        <td align="right">
            {{ Form::label('txtNombreUsuario', 'Nombre de Usuario') }}
        </td>
        <td>
            {{ Form::text('txtNombreUsuario', @$txtNombreUsuario) }}
        </td>
    </tr>
    <tr>
        <td align="right">
            {{ Form::label('txtPassword', 'Contraseña') }}
        </td>
        <td>
            {{ Form::password('txtPassword') }}
        </td>
    </tr>
    <tr>
        <td colspan="2" align="right">
            {{ Form::submit('Iniciar') }}
        </td>
    </tr>
</table>
{{ Form::close() }}
@if($errors->first('errores'))
    <div style="background-color: #ff4b24; color: white; padding: 10px; border: solid 10px #ed4621; text-align: center;">{{$errors->first('errores')}}</div>
@endif
@endsection

@layout('client.main')

@section('menu')
<!--heredamos con parent lo que hay en la plantilla base pero añadimos otro elemento al menú-->
@parent
@endsection

@section('slider')
@endsection

@section('titulo_seccion')
    <h2>Contactenos</h2>
@endsection

@section('contenido')
{{ Form::open() }}
<table align="center">
    <tr>
        <td>{{ Form::label('txtNombre', 'Nombre') }}</td>
        <td>{{ Form::text('txtNombre', '', array('required')) }}</td>
    </tr>
    <tr>
        <td>{{ Form::label('txtApp', 'Apellido Paterno') }}</td>
        <td>{{ Form::text('txtApp', '', array('required')) }}</td>
    </tr>
    <tr>
        <td>{{ Form::label('txtApm', 'Apellido Materno') }}</td>
        <td>{{ Form::text('txtApm') }}</td>
    </tr>
    <tr>
        <td>{{ Form::label('txtDireccion', 'Direccion') }}</td>
        <td>{{ Form::text('txtDireccion') }}</td>
    </tr>
    <tr>
        <td>{{ Form::label('txtTelefono', 'Telefono') }}</td>
        <td>{{ Form::telephone('txtTelefono', '', array('required')) }}</td>
    </tr>
    <tr>
        <td>{{ Form::label('txtEmail', 'Correo Electronico') }}</td>
        <td>{{ Form::email('txtEmail') }}</td>
    </tr>
    <tr>
        <td colspan="2" align="center">
            {{ Form::Label('txtDescripcionSolicitud', 'Descripcion de la solicitud') }}
        </td>
    </tr>
    <tr>
        <td colspan="2" align="center">
            {{ Form::textarea('txtDescripcionSolicitud', '', array('required')) }}
        </td>
    </tr>
    <!--
    <tr>
        <td colspan="2">
            {{ Form::label('scbAcuerdo', 'Estoy de acuerdo con el acuerdo de privacidad', array('style'=>'font-size: 10px;')) }}
            {{ Form::checkbox('scbAcuerdo', 1, true) }}
        </td>
    </tr>
    <tr>
        <td colspan="2">
            {{ Form::label('scbSuscripcion', 'Deseo registrarme', array('style'=>'font-size: 10px;')) }}
            {{ Form::checkbox('scbSuscripcion', 1, true) }} 
            {{HTML::link('#','Acuerdo de privacidad', array('style'=>'font-size: 10px;'))}}
        </td>
    </tr>
    -->
    <tr>
        <td colspan="2" align="right">
            {{ Form::submit('Contactar') }}
        </td>
    </tr>
</table>
{{ Form::close() }}
@if($errors->first('errores'))
<div class="message">{{$errors->first('errores')}}</div>
@endif
@endsection
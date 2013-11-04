@layout('admin.administradores.main')

@section('menu_admin')
    @parent
@endsection

@section('contenido_admin')
    <h3>Nuevo Administrador</h3>
    <div style="padding: 10px; text-align: center; background-color: #f7f7f7; border: solid 1px #efefef; width: 300px; margin: 0 auto; margin-bottom: 20px;">Todos los campos con asterisco son requeridos</div>
    {{Form::open()}}
    <table align="center">
        <tr>
            <td>
                {{Form::label('nombre','Nombre *')}}
            </td>
            <td>
                {{Form::text('nombre', Input::old('nombre'))}}
            </td>
            <td>
                {{$errors->first('nombre')}}
            </td>
        </tr>
        <tr>
            <td>
                {{Form::label('app','Apellido Paterno *')}}
            </td>
            <td>
                {{Form::text('app', Input::old('app'))}}
            </td>
            <td>
                {{$errors->first('app')}}
            </td>
        </tr>
        <tr>
            <td>
                {{Form::label('apm','Apellido Materno')}}
            </td>
            <td>
                {{Form::text('apm', Input::old('apm'))}}
            </td>
            <td>
                {{$errors->first('apm')}}
            </td>
        </tr>
        <tr>
            <td>
                {{Form::label('direccion','Direccion *')}}
            </td>
            <td>
                {{Form::text('direccion', Input::old('direccion'))}}
            </td>
            <td>
                {{$errors->first('direccion')}}
            </td>
        </tr>
        <tr>
            <td>
                {{Form::label('telefono','Telefono * ')}}
            </td>
            <td>
                {{Form::telephone('telefono', Input::old('telefono'))}}
            </td>
            <td>
                {{$errors->first('telefono')}}
            </td>
        </tr>
        <tr>
            <td>
                {{Form::label('email','E-Mail')}}
            </td>
            <td>
                {{Form::email('email', Input::old('email'))}}
            </td>
            <td>
                {{$errors->first('email')}}
            </td>
        </tr>
        <tr>
            <td>
                {{Form::label('nikname', 'NikName *')}}
            </td>
            <td>
                {{Form::text('nikname', Input::old('nikname'))}}
            </td>
            <td>
                {{$errors->first('nikname')}}
            </td>
        </tr>
        <tr>
            <td>
                {{Form::label('password', 'Password *')}}
            </td>
            <td>
                {{Form::password('password')}}
            </td>
            <td>
                {{$errors->first('password')}}
            </td>
        </tr>
        <tr>
            <td>
                {{Form::label('password_confirmation', 'Confirmar Password *')}}
            </td>
            <td>
                {{Form::password('password_confirmation')}}
            </td>
            <td>
                {{$errors->first('password_confirmation')}}
            </td>
        </tr>
        <tr>
            <td colspan="3" align="right">
                {{Form::submit('Crear')}}
            </td>
        </tr>
    </table>
    {{Form::close()}}
@endsection
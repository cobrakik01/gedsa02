@layout('admin.administradores.main')

@section('menu_admin')
    @parent
@endsection

@section('contenido_admin')
    <h3>Editar Administrador</h3>
    <div class="message warning" style="margin-bottom: 20px;">Todos los campos con asterisco <span style="color: red;">*</span> son requeridos</div>
    {{Form::open()}}
    
    <div style="overflow: hidden;">
        <fieldset style="float: left; width: 45%; border-radius: 5px; -moz-border-radius: 5px; -webkit-border-radius: 5px;">
            <legend>Información personal</legend>
            <table align="center">
                <tr>
                    <td>
                        {{Form::label('nombre','Nombre ')}} <span style="color: red;">*</span>
                    </td>
                    <td>
                        {{Form::text('nombre', ($us_desc)?$us_desc->nombre:Input::old('nombre'))}}
                    </td>
                    <td>
                        {{$errors->first('nombre')}}
                    </td>
                </tr>
                <tr>
                    <td>
                        {{Form::label('app','Apellido Paterno')}} <span style="color: red;">*</span>
                    </td>
                    <td>
                        {{Form::text('app', ($us_desc)?$us_desc->apellido_paterno:Input::old('app'))}}
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
                        {{Form::text('apm', ($us_desc)?$us_desc->apellido_materno:Input::old('apm'))}}
                    </td>
                </tr>
                <tr>
                    <td>
                        {{Form::label('direccion','Direccion')}} <span style="color: red;">*</span>
                    </td>
                    <td>
                        {{Form::text('direccion', ($us_desc)?$us_desc->direccion:Input::old('direccion'))}}
                    </td>
                    <td>
                        {{$errors->first('direccion')}}
                    </td>
                </tr>
                <tr>
                    <td>
                        {{Form::label('telefono','Telefono')}} <span style="color: red;">*</span>
                    </td>
                    <td>
                        {{Form::telephone('telefono', ($us_desc)?$us_desc->telefono:Input::old('telefono'))}}
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
                        {{Form::email('email', ($us_desc)?$us_desc->email:Input::old('email'))}}
                    </td>
                    <td>
                        {{$errors->first('email')}}
                    </td>
                </tr>
            </table>
        </fieldset>
    
        <fieldset style="float: left; width: 45%; border-radius: 5px; -moz-border-radius: 5px; -webkit-border-radius: 5px;">
            <legend>Información de cuenta</legend>
            
            <table>
                <tr>
                    <td>
                        Nik Name
                    </td>
                    <td>
                        {{($us)?$us->nombre:Input::old('nikname')}}
                        {{Form::hidden('nikname', ($us)?$us->nombre:Input::old('nikname'))}}
                    </td>
                </tr>
                <tr>
                    <td>
                        {{Form::label('password_old', 'Password Actual')}} <span style="color: red;">*</span>
                    </td>
                    <td>
                        {{Form::password('password_old')}}
                    </td>
                    <td>
                        {{$errors->first('password_old')}}
                    </td>
                </tr>
                <tr>
                    <td>
                        {{Form::label('password', 'Nuevo Password')}} <span style="color: red;">*</span>
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
                        {{Form::label('password_confirmation', 'Confirmar Password')}} <span style="color: red;">*</span>
                    </td>
                    <td>
                        {{Form::password('password_confirmation')}}
                    </td>
                    <td>
                        {{$errors->first('password_confirmation')}}
                    </td>
                </tr>
            </table>
        </fieldset>
    </div>
    <table style="margin-top: 10px;" align='center'>
        <tr>
            <td>
                {{Form::submit('Guardar Cambios', array())}}
            </td>
        </tr>
    </table>
    {{Form::hidden('id', base64_encode(($us)?$us->id:Input::old('id')))}}
    {{Form::close()}}
@endsection
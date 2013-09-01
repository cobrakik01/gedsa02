@layout('admin.administradores.main')

@section('menu_admin')
    @parent
@endsection

@section('contenido_admin')
    @if($us_desc)
    <p>
    <table class="tresult" width='100%'>
            <tr>
                <th colspan="2">
                    Administrador Seleccionado
                </th>
            </tr>
            <tr>
                <td width='100px'>
                    <strong>Administrador</strong>
                </td>
                <td>
                    <strong>{{$us_desc->administrador()->nombre}}</strong>
                </td>
            </tr>
            <tr>
                <td>
                    Nombre
                </td>
                <td>
                    {{$us_desc->nombre . ' ' . $us_desc->apellido_paterno . ' ' . $us_desc->apellido_materno}}
                </td>
            </tr>
            <tr>
                <td>
                    Direccion
                </td>
                <td>
                    {{$us_desc->direccion}}
                </td>
            </tr>
            <tr>
                <td>
                    Telefono
                </td>
                <td>
                    {{$us_desc->telefono}}
                </td>
            </tr>
            <tr>
                <td>
                    E-Mail
                </td>
                <td>
                    {{$us_desc->email}}
                </td>
            </tr>
        </table>
    </p>
    <div style="overflow: hidden;">
        {{HTML::link('admin/administradores/editar/' . base64_encode($us_desc->administrador()->id),'Editar', array('class'=>'btn', 'style'=>'float: right;'))}}
    </div>
    @else
    No existe el usuario solicitado
    @endif
@endsection
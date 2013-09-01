@layout('admin.administradores.main')

@section('menu_admin')
    @parent
@endsection

@section('contenido_admin')
<h3>Busquedas con filtros</h3>
    
    {{Form::open('admin/administradores/buscar','GET')}}
        <table align="center">
            <tr>
                <td align="center">
                    {{Form::label('txtBuscar','Palabra a buscar')}}
                </td>
                <td align="center">
                    {{Form::label('listFiltro','Buscar por')}}
                </td>
                <td align="center">
                    {{Form::label('listOrden','Resultados')}}
                </td>
                <td align="center">
                    {{Form::label('listResultadosPorPagina','Por pagina')}}
                </td>
            </tr>
            <tr>
                <td>
                    {{Form::search('txtBuscar', @$txtBuscar)}}
                </td>
                <td>
                    {{Form::select('listFiltro', array('nom_administrador' => 'Nombre Administrador', 'id_admin' => 'Id Administrador', 'descripcion_nom' => 'Nombre Real', 'descripcion_app' => 'Apellido Paterno', 'descripcion_apm' => 'Apellido Materno', 'email' => 'E-Mail', 'fecha_reg' => 'Fecha de registro (aaaa-mm-dd)', 'telefono' => 'Telefono'), @$listFiltro)}}
                </td>
                <td>
                    {{Form::select('listOrden', array('asc' => 'Ascendente', 'desc' => 'Descendente'), @$listOrden)}}
                </td>
                <td align="center">
                    {{Form::select('listResultadosPorPagina', array('10' => '10', '15' => '15', '25' => '25', '30' => '30', '50' => '50'), @$listResultadosPorPagina)}}
                </td>
                <td>
                    {{Form::submit('Buscar')}}
                </td>
            </tr>
        </table>
    {{Form::close()}}
    
    @if($users)
        @if($users->results)
            <table class="tresult" align="center" width='100%'>
                <tr>
                    <th width='30px'>ID</th>
                    <th width='120px'>Fecha Registro</th>
                    <th>Nombre</th>
                    <th width='50px'>Activo</th>
                    <th width='200px'>Accion</th>
                </tr>
                @foreach($users->results as $us)
                <tr>
                    <td align='center'>
                    {{$us->id}}
                    </td>
                    <td>
                        {{$us->descripcion()->created_at}}
                    </td>
                    <td>
                    {{$us->nombre}}
                    </td>
                    <td align='center'>
                    @if($us->activo)
                        Si
                    @else
                        No
                    @endif
                    </td>
                    <td align='center'>
                        {{HTML::link('admin/administradores/ver/' . base64_encode($us->id),'Ver')}}
                        @if($us->activo)
                        {{HTML::link('admin/administradores/desactivar/' . base64_encode($us->id),'Desactivar')}}
                        @else
                        {{HTML::link('admin/administradores/activar/' . base64_encode($us->id),'Activar')}}
                        @endif

                        {{HTML::link('admin/administradores/editar/' . base64_encode($us->id),'Editar')}}
                        {{HTML::link('admin/administradores/eliminar/' . base64_encode($us->id),'Eliminar')}}
                    </td>
                </tr>
                @endforeach
            </table>
            {{$users->appends(array('txtBuscar'=>Input::get('txtBuscar'),'listFiltro'=>Input::get('listFiltro'),'listOrden'=>Input::get('listOrden'),'listResultadosPorPagina'=>Input::get('listResultadosPorPagina')))->links()}}
        @else
        <table align="center">
            <tr>
                <td>
                    <h3>No se encontraron registros</h3>
                </td>
            </tr>
        </table>
        @endif
    @endif
    
    @if($us_desc)
        @if($us_desc->results)
            <table class="tresult" align="center">
                <tr>
                    <th>ID</th>
                    <th>Fecha Registro</th>
                    <th>Admin</th>
                    <th>Activo</th>
                    <th>Accion</th>
                    <th>Nombre Completo</th>
                    <th>Telefono</th>
                    <th>E-Mail</th>
                </tr>
                @foreach($us_desc->results as $desc)
                <tr>
                    <td>{{$desc->administrador()->id}}</td>
                    <td>{{$desc->created_at}}</td>
                    <td>{{$desc->administrador()->nombre}}</td>
                    <td>
                        @if($desc->administrador()->activo)
                            Si
                        @else
                            No
                        @endif
                    </td>
                    <td>
                        {{HTML::link('admin/administradores/ver/' . base64_encode($desc->administrador()->id),'Ver')}}
                        @if($desc->administrador()->activo)
                        {{HTML::link('admin/administradores/desactivar/' . base64_encode($desc->administrador()->id),'Desactivar')}}
                        @else
                        {{HTML::link('admin/administradores/activar/' . base64_encode($desc->administrador()->id),'Activar')}}
                        @endif

                        {{HTML::link('admin/administradores/editar/' . base64_encode($desc->administrador()->id),'Editar')}}
                        {{HTML::link('admin/administradores/eliminar/' . base64_encode($desc->administrador()->id),'Eliminar')}}
                    </td>
                    <td>
                        {{$desc->nombre . ' ' . $desc->apellido_paterno . ' ' . $desc->apellido_materno}}
                    </td>
                    <td>
                        {{$desc->telefono}}
                    </td>
                    <td>
                        {{$desc->email}}
                    </td>
                </tr>
                @endforeach
            </table>
        @else
            <table align="center">
                <tr>
                    <td>
                        <h3>No se encontraron registros</h3>
                    </td>
                </tr>
            </table>
        @endif
    @endif
@endsection
@layout('admin.presentaciones.main')

@section('menu_albums')
    @parent
@endsection

@section('menu_items_albums')
    @parent
@endsection

@section('contenido_albums')
    {{Form::open('admin/presentaciones/buscar_presentacion', 'GET')}}
    <table width='100%' style="margin-top: 20px;">
        <tr>
            <td width='250px'>
                {{Form::label('txtBuscar', 'Nombre de Presentación a buscar')}}
            </td>
            <td>
                {{Form::text('txtBuscar', Input::get('txtBuscar') ? Input::get('txtBuscar') : Input::old('txtBuscar'))}}
            </td>
            <td width='50px'>
                {{Form::submit('Buscar')}}
            </td>
        </tr>
    </table>
    {{Form::close()}}
    
    <div>
        @if($presentaciones->total > 0)
        @foreach($presentaciones->results as $presentacion)
        
        @endforeach
        <table class="tresult" width='100%'>
            <tr>
                <th width='130px'>
                Nombre
                </th>
                <th>
                    Descripción
                </th>
                <th width='108px'>
                    Creado
                </th>
                <th width='106px'>
                    Acción
                </th>
            </tr>
            <tr>
                <td>
                {{HTML::link('admin/presentaciones/ver_presentacion/?n=' . base64_encode($presentacion->nombre) . '&i=' . base64_encode($presentacion->administradores_id), $presentacion->nombre)}}
                </td>
                <td>
                    {{$presentacion->descripcion}}
                </td>
                <td>
                    {{$presentacion->created_at}}
                </td>
                <td align="center">
                    @if(!PresentacionPrincipal::existe())
                        {{HTML::link('admin/presentaciones/mis_presentaciones/establecer_principal/?n=' . base64_encode($presentacion->nombre) . '&i=' . base64_encode($presentacion->administradores_id), 'Establecer', array('title'=>'Al dar clic esta presentacion se establecera como presentacion principal, y esta se mostrara en la pagina principal del sitio web.'))}}
                    @endif
                    {{HTML::link('admin/presentaciones/eliminar_presentacion/?n=' . base64_encode($presentacion->nombre) . '&i=' . base64_encode($presentacion->administradores_id), 'Eliminar')}}
                </td>
            </tr>
        </table>
        <table align='center'>
            <tr>
                <td>
                    {{$presentaciones->appends(array('txtBuscar'=>Input::get('txtBuscar')))->links()}}
                </td>
            </tr>
        </table>
        @else
        <div class="message">
            No se encontro ninguna presentación.
        </div>
        @endif
    </div>
@endsection
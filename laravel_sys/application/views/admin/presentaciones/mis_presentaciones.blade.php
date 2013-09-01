@layout('admin.presentaciones.main')

@section('menu_albums')
    @parent
@endsection

@section('menu_items_albums')
    @parent
@endsection

@section('contenido_albums')
    <h3>Presentaciones</h3>
    
    @if($presentaciones->total > 0)
    <div class="message" style="margin-bottom: 20px; overflow: hidden;">
    @if($presentacion_principal)
        <div style="float: left; width: 734px;">
            <h3>Presentacion principal</h3>
            <p>
                {{HTML::link('admin/presentaciones/ver_presentacion/?n=' . base64_encode($presentacion_principal->presentacion()->nombre) . '&i=' . base64_encode($presentacion_principal->presentacion()->administradores_id),$presentacion_principal->presentaciones_nombre)}}
            </p>
        </div>
        <div style="float: left;">
            {{HTML::link('admin/presentaciones/mis_presentaciones/remover_principal/?n=' . base64_encode($presentacion_principal->presentacion()->nombre) . '&i=' . base64_encode($presentacion_principal->presentacion()->administradores_id), 'Remover', array('class'=>'btn'))}}
        </div>
    @else
        <h2>
            Sin presentacion principal.
        </h2>
        <p>
            Puedes elegir alguna presentación disponible dando clic en la opción de <strong>Establecer</strong> (solo se puede establecer una sola presentación como principal) en la sección de <strong>Acción</strong> de la tabla de abajo.
        </p>
    @endif
    </div>
    @if($errors->first('errores'))
    <div class="warning">
        {{$errors->first('errores')}}
    </div>
    @endif
    
    <table class="tresult" align="center" width='100%'>
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
        @foreach($presentaciones->results as $presentacion)
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
        @endforeach
    </table>
    <table align="center">
        <tr>
            <td>
                {{$presentaciones->links()}}
            </td>
        </tr>
    </table>
    @else
    <div class="message">
        <h2>Sin presentaciones</h2>
        <p>
            Aun no tienes ninguna presentación, puedes crear una nueva presentacion dando clic {{HTML::link('admin/presentaciones/nueva_presentacion/','aquí')}}
            o dando clic en la opción <strong>"Nueva Presentación"</strong> en el menu de arriba.
        </p>
    </div>
    @endif
@endsection
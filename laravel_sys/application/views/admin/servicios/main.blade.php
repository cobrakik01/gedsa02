@layout('admin.main')

@section('contenido')
<h2 style="text-align: right;"> {{HTML::link('admin/perfil',Auth::user()->nombre)}} - Administración de Servicios</h2>
    <div style="overflow: hidden;">
    @section('menu_servicios')
        <ul class="v-menu">
            <li>
                {{HTML::link('admin/servicios/nuevo','Nuevo servicio', array('class'=> isset($activeNuevo) ? 'linkActive' : ''))}}
            </li>
            <li>
                {{HTML::link('admin/servicios/todos','Todos los servicios', array('class'=> isset($activeTodos) ? 'linkActive' : ''))}}
            </li>
            <li>
                {{HTML::link('admin/servicios/buscar','Buscar servicio', array('class'=> isset($activeBuscar) ? 'linkActive' : ''))}}
            </li>
        </ul>
    @yield_section

    <div style="float: left; width: 78%; border: solid 1px #dbdbdb; margin-left: 20px; padding: 10px; box-shadow: #e5e5e5 0px 0px 10px 1px; -moz-box-shadow: #e5e5e5 0px 0px 10px 1px; -webkit-box-shadow: #e5e5e5 0px 0px 10px 1px;">
        @section('contenido_servicios')
        @yield_section
        </div>
    </div>
@endsection
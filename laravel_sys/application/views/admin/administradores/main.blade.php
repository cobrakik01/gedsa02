@layout('admin.main')

@section('menu')
    @parent
@endsection

@section('contenido')
    <h2 style="text-align: right;"> {{HTML::link('admin/perfil',Auth::user()->nombre)}} - Administradores</h2>
    @section('menu_admin')
    <div class="menu">
        <ul>
            <li>
                {{HTML::link('admin/administradores/nuevo','Nuevo administrador', array('class'=> isset($activeNuevo) ? 'linkActive' : ''))}}
            </li>
            <li>
                {{HTML::link('admin/administradores/result/todos','Todos los administradores', array('class'=> isset($activeTodos) ? 'linkActive' : ''))}}
            </li>
            <li>
                {{HTML::link('admin/administradores/result/activos','Administradores activos', array('class'=> isset($activeActivos) ? 'linkActive' : ''))}}
            </li>
            <li>
                {{HTML::link('admin/administradores/result/inactivos','Administradores inactivos', array('class'=> isset($activeInactivos) ? 'linkActive' : ''))}}
            </li>
            <li>
                {{HTML::link('admin/administradores/buscar','Buscar administradores', array('class'=> isset($activeBuscar) ? 'linkActive' : ''))}}
            </li>
        </ul>
    </div>
    @yield_section

    @section('contenido_admin')    
    @yield_section
@endsection
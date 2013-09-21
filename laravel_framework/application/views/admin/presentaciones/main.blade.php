@layout('admin.main')

@section('contenido')
<h2 style="text-align: right;"> {{HTML::link('admin/perfil',Auth::user()->nombre)}} - Administración de Presentaciones</h2>
@section('menu_albums')
<div class="menu">
    <ul>
        @section('menu_items_albums')
        <li>
            <!-- <a href="#" id="btnNuevaPresentacion">Nueva Presentación</a> -->
            {{HTML::link('admin/presentaciones/nueva_presentacion','Nueva Presentación', array('class'=> isset($activeNuevo) ? 'linkActive' : ''))}}
        </li>
        <li>
            {{HTML::link('admin/presentaciones/mis_presentaciones','Presentaciones', array('class'=> isset($activeMisPresentaciones) ? 'linkActive' : ''))}}
        </li>
        <li>
            {{HTML::link('admin/presentaciones/buscar_presentacion','Buscar Presentaciones', array('class'=> isset($activeBuscar) ? 'linkActive' : ''))}}
        </li>
        @yield_section
    </ul>
</div>
@yield_section

@section('contenido_albums')    
@yield_section
@endsection
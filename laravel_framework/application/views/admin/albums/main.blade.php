@layout('admin.main')

@section('contenido')
<h2 style="text-align: right;"> {{HTML::link('admin/perfil',Auth::user()->nombre)}} - Administración de Albums</h2>
    @section('menu_albums')
    <div class="menu">
        <ul>
            @section('menu_items_albums')
            <li>
                {{HTML::link('admin/albumes/nuevo','Nuevo álbum', array('class'=> isset($activeNuevo) ? 'linkActive' : ''))}}
            </li>
            <li>
                {{HTML::link('admin/albumes/mis_albums','Mis álbumes', array('class'=> isset($activeMisAlbumes) ? 'linkActive' : ''))}}
            </li>
            <li>
                {{HTML::link('admin/albumes/todos','Mostrar todos los álbumes', array('class'=> isset($activeTodos) ? 'linkActive' : ''))}}
            </li>
            <li>
                {{HTML::link('admin/albumes/buscar_album','Buscar álbum', array('class'=> isset($activeBuscarAlbumes) ? 'linkActive' : ''))}}
            </li>
            @yield_section
        </ul>
    </div>
    @yield_section

    @section('contenido_albums')    
    @yield_section
@endsection
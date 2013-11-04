<div id="content-ajax" style="font-size: 14px;">
    @section('menu_albums')
    <div class="menu">
        <ul>
            @section('menu_items_albums')
            <li>
                {{HTML::link('','Mis Álbumes', array('id'=>'mis_albumes_ajax'))}}
            </li>
            <li>
                {{HTML::link('','Todos los Álbumes', array('id'=>'todas_las_presentaciones'))}}
            </li>
            @yield_section
        </ul>
    </div>
    <script>
        $(document).ready(function() {
            cbk("#mis_albumes_ajax").presentacion.misAlbumes();
            cbk("#todas_las_presentaciones").presentacion.todosLosAlbumes();
        });
    </script>
    @yield_section

    @section('contenido_albums')    
    @yield_section
</div>
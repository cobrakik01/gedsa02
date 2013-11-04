@layout('admin.presentaciones.main')

@section('menu_albums')
    @parent
@endsection

@section('menu_items_albums')
    @parent
@endsection

@section('contenido_albums')
    <h3>
        Presentacion <span style="font-weight: bold;">{{$presentacion->nombre}}</span>
        {{HTML::link('admin/presentaciones/editar_nombre/?n=' . base64_encode($presentacion->nombre) . '&i=' . base64_encode($presentacion->administradores_id), 'editar')}}
    </h3>
    <div style="margin-bottom: 30px;">
        <div id="descripcion-presentacion" style="overflow: hidden;">
            <div style="float: left; width: 690px;">
                @if(strlen($presentacion->descripcion) > 0)
                    {{$presentacion->descripcion}}
                @else
                    Esta presentación aún no tiene descripcion.
                @endif
                {{HTML::link('admin/presentaciones/editar_descripcion/?n=' . base64_encode($presentacion->nombre) . '&i=' . base64_encode($presentacion->administradores_id), 'editar')}}
            </div>
            @if(!PresentacionPrincipal::existe())
            <div style="float: left;">
                {{HTML::link('admin/presentaciones/mis_presentaciones/establecer_principal/?n=' . base64_encode($presentacion->nombre) . '&i=' . base64_encode($presentacion->administradores_id),'Establecer como principal', array('class'=>'btn', 'style'=>'font-size: 12px;', 'title'=>'Al dar clic esta presentacion se establecera como presentacion principal, y esta se mostrara en la pagina principal del sitio web.'))}}
            </div>
            @endif
        </div>
        <table align="right">
            <tr>
                <td>
                    <button id="btnAgregarFotos" style="display: none;">Agregar fotos a la presentación</button>
                </td> 
            </tr>
        </table>
    </div>
    <div id="content-ajax-presentacion">
        <div style="margin-top: 10px; margin-bottom: 10px;">
            <a id="lnkAgregarFotos" href="#" style="text-align: center;" class="btn">Agregar fotos a la presentación</a>
        </div>
        
        @if($fotos->total > 0)
        <div class="wraper-photo">
            <ul>
                @foreach($fotos->results as $foto)
                    <li title="{{(strlen($foto->descripcion) > 0) ? 'Descripción: ' . $foto->descripcion : ''}}">
                        <div class="container-photo">
                            {{ HTML::image($foto->url, $foto->nombre, array('border'=>'0')) }}
                            <ul class="controls-photo">
                            <li>
                                {{HTML::link('admin/albumes/editar_foto/' . $foto->id,'', array('class'=>'btnEditControl', 'title'=>'Editar Foto'))}}
                            </li>
                            <li>
                                {{HTML::link('admin/presentaciones/ver_presentacion/eliminar_foto/?pnom=' . base64_encode($presentacion->nombre) . '&fid=' . base64_encode($foto->id) , '', array('class'=>'btnDeleteControl', 'title'=>'Eliminar Foto'))}}
                            </li>
                            </ul>
                            <div class="description-photo-bg"></div>
                            <div class="description-photo">
                                {{$foto->shortDescription()}}
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
        <table align='center'>
            <tr>
                <td>
                    {{$fotos->appends(array('n'=>Input::get('n'), 'i'=>Input::get('i')))->links()}}
                </td>
            </tr>
        </table>
        @else
        <div class="message">
            <h3>Si fotos</h3>
            <p>
                No se encontraron fotos de esta presentación. puedes agregar fotos con el boton de arriba.
            </p>
        </div>
        @endif
    </div>

    <script type="text/javascript">
        (function(){
            $(".wraper-photo ul li").tooltip();
            $("#lnkAgregarFotos").click(function(e){
                e.preventDefault();
                cbk.presentacion.mostrarFotos("#content-ajax-presentacion");
                $("#btnAgregarFotos").fadeIn("slow");
            });
            $("#btnAgregarFotos").click(function(){
                cbk.presentacion.agregarFotos("{{base64_encode($presentacion->nombre)}}", "{{base64_encode($presentacion->administradores_id)}}");
            });
        })();
    </script>
@endsection
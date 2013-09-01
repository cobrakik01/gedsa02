@layout('admin.servicios.main')

@section('menu_servicios')
@parent
@endsection

@section('contenido_servicios')
<div id="dlg" style="width: 100%; height: 100%; position: fixed; top: 0px; left: 0px; z-index: 100; display: none;">
    <div style="background-color: #eaeaea; width: 100%; height: 100%; position: fixed; top: 0px; left: 0px; opacity: 0.7;">
    </div>
    <div style="width: 100%; height: 100%; position: fixed; top: 0px; left: 0px;">
        <div id="dlg-txt" class="message" style="background-color: #ffffff; width: 500px; margin: 0 auto; margin-top: 10%; padding: 10px;">
        </div>
    </div>
</div>

<div style="overflow: hidden;">
    <div style="display: none;" id="old_nombre_servicio">{{$servicio->nombre}}</div>
    <h2 style="float: left; width: 91%;" id="nombre_servicio">{{$servicio->nombre}}</h2>
    <div style="float: left;">
        <a href="#" id="lnk_editar_nombre">Editar</a>
        <a href="#" id="lnk_guardar_nombre" style="display: none;">Guardar</a>
    </div>
</div>

<div style="font-size: 11px; overflow: hidden;">
    <div style="float: left; width: 92%;">
        <strong>Autor: {{$servicio->administrador()->nombre}}</strong> <br />
        Publicado: {{$servicio->created_at}}
    </div>
    <div style="float: left; font-size: 15px;">
        <a href="#" id="lnk_editar_descripcion">Editar</a>
        <a href="#" id="lnk_guardar_descripcion" style="display: none;">Guardar</a>
    </div>
</div>

<div>
    <p id="descripcion_servicio">
        {{$servicio->descripcion}}
    </p>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $("#lnk_editar_nombre").click(function(e) {
            e.preventDefault();
            $(this).fadeOut("fast", function() {
                $("#lnk_guardar_nombre").fadeIn("slow");
                $("#nombre_servicio").attr('contenteditable', true).focus();
            });
        });

        $("#lnk_guardar_nombre").click(function(e) {
            e.preventDefault();
            $(this).fadeOut("fast", function() {
                $("#lnk_editar_nombre").fadeIn("slow");
                var oldServiceName = $("#old_nombre_servicio").html();
                var newServiceName = $("#nombre_servicio").attr('contenteditable', false).html();
                
                $.ajax({
                    url: "/admin/servicios/editar_nombre/",
                    type: "POST",
                    data: {old_name:oldServiceName, new_name: newServiceName},
                    cache: false,
                    error: function(jqXHR, textStatus, errorThrow) {
                        $("#msg-ajax").html(jqXHR.responseText);
                    },
                    beforeSend: function(jqXHR, settings) {
                        $("#dlg-txt").html("Guardando cambios...");
                        $("#dlg").fadeIn("slow");
                    },
                    success: function(dataResponse) {
                        $("#nombre_servicio").html(dataResponse);
                        $("#old_nombre_servicio").html(newServiceName);
                        $("#dlg").fadeOut("slow");
                    }
                });
            });
        });

        $("#lnk_editar_descripcion").click(function(e) {
            e.preventDefault();
            $(this).fadeOut("fast", function() {
                $("#lnk_guardar_descripcion").fadeIn("slow");
                $("#descripcion_servicio").attr('contenteditable', true).focus();
            });
        });

        $("#lnk_guardar_descripcion").click(function(e) {
            e.preventDefault();
            $(this).fadeOut("fast", function(){
                $("#lnk_editar_descripcion").fadeIn("slow");
                var serviceName = $("#old_nombre_servicio").html();
                var description = $("#descripcion_servicio").attr('contenteditable', false).html();
                
                
                $.ajax({
                    url: "/admin/servicios/editar_descripcion/",
                    type: "POST",
                    data: {service_name:serviceName, description: description},
                    cache: false,
                    error: function(jqXHR, textStatus, errorThrow) {
                        $("#msg-ajax").html(jqXHR.responseText);
                    },
                    beforeSend: function(jqXHR, settings) {
                        $("#dlg-txt").html("Guardando cambios...");
                        $("#dlg").fadeIn("slow");
                    },
                    success: function(dataResponse) {
                        $("#descripcion_servicio").html(dataResponse);
                        $("#dlg").fadeOut("slow");
                    }
                });
            });
        });
    });
</script>
@endsection
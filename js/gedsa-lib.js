var util = {
    root: "/",
    loaderHtml: "<div style=\"text-align: center;\" id=\"loading\"><img src=\"/img/sys_admin/load.gif\" /><br />Cargando...</div>",
    currentUrl: $(location).attr("href"),
    /**
     * 
     * @param {type} data {url:"", data:{}, container:"selector", innerHtml: "html", back: boolean, server:boolean} server: Indica que utilizara la url a partir de los directorios del servidor.
     * @returns {undefined}
     */
    load: function(data) {
        var back = data.back || true;
        var url = "";
        var server = data.server || false;
        if (server) {
            url = cbk.util.root + data.url;
        } else {
            url = data.url;
        }

        var dataSend = data.data;
        var container = data.container;
        var appendHtml = back ? ("<div style='margin-bottom: 20px;'><a href='" + cbk.util.currentUrl + "'><-Cancelar</a></div>" + (data.innerHtml || "")) : (data.innerHtml || "");

        $.ajax({
            url: url,
            type: "GET",
            data: dataSend,
            cache: false,
            error: function(jqXHR, textStatus, errorThrow) {
                $(container).html(jqXHR.responseText);
            },
            beforeSend: function(jqXHR, settings) {
                $(container).html(cbk.util.loaderHtml);
            },
            success: function(dataResponse) {
                $(container).html(appendHtml + dataResponse);
            }
        });
    }
};

var album = {
    uri: "admin/albumes_ajax/",
    container: "#content-ajax-album",
    open: function(selector) {
        var id = $($(selector).children().get(0)).html();
        cbk.util.load({
            server: true,
            url: cbk.album.uri + "open/",
            container: cbk.presentacion.container,
            data: {"id": id}
        });
    },
    open2: function(id, urlBack, nPage) {
        cbk.util.load({
            innerHtml: "<a href='#' id='lnkBackAlbum'><-Seleccionar otro álbum</a> <script>(function(){$('#lnkBackAlbum').click(function(e){e.preventDefault(); cbk.util.load({back: false, server: true, url: '" + urlBack + "', container: cbk.presentacion.container, data: {'page': " + nPage + "}}); });})();</script>",
            server: true,
            url: cbk.album.uri + "open/",
            container: cbk.presentacion.container,
            data: {"id": id}
        });
    },
    load: function(selector) {
        cbk.util.load({
            server: true,
            url: cbk.album.uri + "load/",
            container: selector
        });
    }
};


var presentacion = {
    uri: "admin/presentaciones/ajax/",
    container: "#content-ajax-presentacion",
    selectedPhotos: [],
    nuevo: function(nombrePresentacion) {
        if (nombrePresentacion == "" || (typeof nombrePresentacion == "undefined")) {
            alert("Elije algun nombre para la presentación");
        } else if (cbk.presentacion.selectedPhotos.length <= 0) {
            alert("Selecciona al menos una foto para poder crear la presentación");
        } else {
            nombrePresentacion = $.trim(nombrePresentacion);
            $.ajax({
                type: "POST",
                url: cbk.util.root + cbk.presentacion.uri + "nuevo",
                data: {nombre: nombrePresentacion, fotosId: cbk.presentacion.selectedPhotos},
                cache: false,
                error: function(jqXHR, textStatus, errorThrow) {
                    $(cbk.presentacion.container).html(jqXHR.responseText);
                },
                beforeSend: function(jqXHR, settings) {
                    $(cbk.presentacion.container).html(cbk.util.loaderHtml);
                },
                success: function(dataResponse) {
                    $(location).attr("href", cbk.util.root + "admin/presentaciones");
                }
            });
        }
    },
    mostrarFotos: function(selector) {
        cbk.album.load(selector);
    },
    agregarFotos: function(nomPresentacionEncode, idAdminEncode) {
        if (cbk.presentacion.selectedPhotos.length <= 0) {
            alert("No has seleccionado ninguna foto");
            return;
        }

        nomPresentacionEncode = $.trim(nomPresentacionEncode);
        $.ajax({
            type: "POST",
            url: cbk.util.root + cbk.presentacion.uri + "agregar",
            data: {nombreEncode: nomPresentacionEncode, idAdminEncode: idAdminEncode, fotosId: cbk.presentacion.selectedPhotos},
            cache: false,
            error: function(jqXHR, textStatus, errorThrow) {
                $(cbk.presentacion.container).html(jqXHR.responseText);
            },
            beforeSend: function(jqXHR, settings) {
                $(cbk.presentacion.container).html(cbk.util.loaderHtml);
            },
            success: function(dataResponse) {
                $(location).attr("href", cbk.util.currentUrl);
                //$(cbk.presentacion.container).html(cbk.util.currentUrl);
            }
        });
    }
};

/**
 * Raiz de objetos
 * @type cbk
 */
cbk = {};
cbk.album = album;
cbk.util = util;
cbk.presentacion = presentacion;
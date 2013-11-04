<div id="content-ajax-presentacion">
    @if($albumes->total > 0)
    <div class="message" style="margin-bottom: 30px;">
        Solo se presentaran los álbumes con fotos
    </div>

    <table class="tresult" align="center" width="100%">
        <tr>
            <th hidden="true">
                Id
            </th>
            <th width="200px">
                Nombre
            </th>
            <th>
                Descripción
            </th>
        </tr>
        @foreach($albumes->results as $album)
        @if(!$album->vacio())
        <tr style="cursor: pointer;">
            <td hidden="true">
                {{$album->id}}
            </td>
            <td>
                {{$album->nombre}}
            </td>
            <td>
                {{$album->descripcion ? $album->descripcion : "sin descripcion"}}
            </td>
        </tr>
        @endif
        @endforeach
    </table>
    <table align="center">
        <tr>
            <td>
                {{$albumes->links()}}
            </td>
        </tr>
    </table>
    @else
    <div class="message">
        <h3>
            Sin Albumes
        </h3>
        <p>
            Aún no puedes crear presentaciones sin antes haber creado al menos un álbum.
            Puedes crear tu primer álbum dando clic {{HTML::link('admin/albumes/nuevo','aquí')}} o dirigete a la sección de <strong>Administrar Álbums</strong> posteriormente da clic en la opción <strong>Nuevo álbum</strong>
        </p>
    </div>
    @endif
    <script type="text/javascript">
        $(document).ready(function() {
            var backAlbums = cbk.album.uri + "load/";

            $("table.tresult tr").click(function() {
                var id = $($(this).children().get(0)).html();
                var nPage = 0;
                if (typeof $("body").find("div.pagination").get(0) != "undefined") {
                    nPage = $("div.pagination ul li a[href='#']").text();
                    if (isNaN(nPage)) {
                        nPage = 0;
                    }
                }
                cbk.album.open2(id, backAlbums, nPage);
            });

            $("div.pagination ul li a").click(function(e) {
                e.preventDefault();
                var href = $(this).attr("href");
                var token1 = href.split('?');
                if (token1.length == 2) {
                    var token2 = token1[1].split('=');
                    var nPage = token2[1];

                    cbk.util.load({
                        back: false,
                        server: true,
                        url: backAlbums,
                        container: cbk.presentacion.container,
                        data: {"page": nPage}
                    });
                }
            });
        });
    </script>
</div>
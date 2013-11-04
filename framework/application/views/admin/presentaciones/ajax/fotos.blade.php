@if($fotos->results)
    <h3>Estas biendo el álbum: <span style="font-weight: bold;">{{$album->nombre}}</span></h3>
    <div id='fotos-seleccionadas' class="message" style="margin: 0 auto; margin-bottom: 10px; text-align: center;width: 300px; font-size: 12px; display: none;">
        0 Fotos seleccionadas.
    </div>
    <div class="wraper-photo">
        <ul>
            @foreach($fotos->results as $foto)
            <li>
                <div class="container-photo" itemid="{{$foto->id}}" title="{{$foto->descripcion}}">
                    {{ HTML::image($foto->url, $foto->nombre, array('border'=>'0')) }}
                    <ul class="controls-photo" style="width: 25px; background-color: #ffffff; left: 180px; top: -205px; border: solid 1px #cccccc;">
                        <li>
                            {{Form::checkbox('foto[]', $foto->id)}}
                        </li>
                    </ul>
                    <div class="description-photo-bg"></div>
                    <div class="description-photo">
                        {{$foto->shortName()}}
                    </div>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
    <table align='center'>
        <tr>
            <td>
                {{$fotos->links()}}
            </td>
        </tr>
    </table>
    <script>
        
        $(document).ready(function(){
            $("div.pagination ul li a").click(function(e){
                e.preventDefault();
                var href = $(this).attr("href");
                
                if(href != "#"){
                    var token1 = href.split('page');
                    if(token1.length == 2){
                        var nPage = token1[1].split('=');
                        if(nPage.length == 2){
                            cbk.util.load({
                                url: href,
                                container: cbk.presentacion.container,
                                data: {page: $.trim(nPage[1]), id:"{{$album->id}}"}
                            });
                        }
                    }
                }
            });
            
            $("input[type='checkbox']").prop("disabled", "disabled");
            $(".container-photo").click(function(e){
                e.preventDefault();
                var idFoto = $(this).attr("itemid");
                 checbox = $($($($(this).children().get(1)).children().get(0)).get(0)).children().get(0);
                 checbox.checked = (checbox.checked) ? false:true;
                 if(checbox.checked){
                     cbk.presentacion.selectedPhotos.push(idFoto);
                     $($($($(this).children().get(1)).children().get(0)).get(0)).css({"background-color":"#99ff99"});
                 } else {
                     cbk.presentacion.selectedPhotos.pop();
                     $($($($(this).children().get(1)).children().get(0)).get(0)).css({"background-color":"#ffffff"});
                 }
                 
                 if(cbk.presentacion.selectedPhotos.length > 0){
                     $("#fotos-seleccionadas").fadeIn("slow");
                 }
                 $("#fotos-seleccionadas").text(cbk.presentacion.selectedPhotos.length + " Fotos seleccionadas.");
            });
        });
    </script>
@endif
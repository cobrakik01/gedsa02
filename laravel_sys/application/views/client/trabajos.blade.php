@layout('client.main')

@section('menu')
<!--heredamos con parent lo que hay en la plantilla base pero añadimos otro elemento al menú-->
@parent
@endsection

@section('slider')
@endsection

@section('titulo_seccion')
    <h2> Nuestros Trabajos </h2>
@endsection

@section('contenido')
    @if($albumes->total > 0)
        @foreach($albumes->results as $album)
        <div class="limites-album">
            <h3 style="padding-top: 10px; padding-left: 10px;"> {{$album->nombre}} <small>{{HTML::link('trabajos/ver_album/' . base64_encode($album->id),'Ver álbum')}}</small> </h3>
            <div style="font-size: 13px; margin-bottom: 20px; margin-left: 50px; font-weight: lighter;">
                {{$album->descripcion}}
            </div>
            
            <?php $fotos = $album->fotos(6); ?>
            @if($fotos->total > 0)
                <div class="marco-album">
                    @foreach($fotos->results as $foto)
                    <div class="cont-foto">
                        {{ HTML::image($foto->url, $foto->nombre, array('width'=>'100%', 'height'=>'100%', 'border'=>'0')) }}
                        <div class="desc-foto">
                            {{$foto->shortDescription(50)}}
                        </div>
                    </div>
                    @endforeach
                </div>
            @endif
            <div style="margin-top: 20px; text-align: center;">
                {{HTML::link('trabajos/ver_album/' . base64_encode($album->id),'Ver álbum completo')}}
            </div>
        </div>
        @endforeach
    @else
        <div style="border: solid 1px #ccccff; padding: 10px; border-radius: 5px;">
            No se encontro ningun álbum.
        </div>
    @endif
    <table align='center'>
        <tr>
            <td>
                {{$albumes->links()}}
            </td>
        </tr>
    </table>
@endsection
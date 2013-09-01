@layout('client.main')

@section('menu')
<!--heredamos con parent lo que hay en la plantilla base pero añadimos otro elemento al menú-->
@parent
@endsection

@section('slider')
@parent
@endsection

@section('titulo_seccion')
<div style="font-stretch: extra-condensed; font-size: 25px; margin-top: 20px;">
    Algunos Servicios
</div>
@endsection

@section('contenido')

    @if($servicios->total > 0)
        @foreach($servicios->results as $servicio)
            <div class="article">
                <div>
                    <h3>
                        {{$servicio->nombre}}
                    </h3>
                    <div>
                        {{$servicio->descripcion()}} {{HTML::link('servicios/ver/' . base64_encode($servicio->nombre), '[...]', 'ver más')}}
                    </div>
                </div>
            </div>
        @endforeach
        <div style="background-color: #f4f4f4; border: solid 1px #e5e5e5; text-align: center; padding: 10px; font-size: 12px;">
            {{HTML::link('servicios','...Mas Servicios...')}}
        </div>
    @else
        <div style="border: solid 1px #ccccff; padding: 10px; border-radius: 5px;">
            No se encontraron servicios disponibles.
        </div>
    @endif
@endsection
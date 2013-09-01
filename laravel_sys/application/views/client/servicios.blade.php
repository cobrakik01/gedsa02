@layout('client.main')

@section('menu')
<!--heredamos con parent lo que hay en la plantilla base pero añadimos otro elemento al menú-->
@parent
@endsection

@section('slider')
@endsection

@section('titulo_seccion')
    <h2> Servicios </h2>
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
    @else
        <div style="border: solid 1px #ccccff; padding: 10px; border-radius: 5px;">
            No se encontraron servicios disponibles.
        </div>
    @endif
@endsection
@layout('client.main')

@section('menu')
<!--heredamos con parent lo que hay en la plantilla base pero añadimos otro elemento al menú-->
@parent
@endsection

@section('slider')
@endsection

@section('titulo_seccion')
    <h2>Servicios</h2>
@endsection

@section('contenido')
<div style="">
    <h3>{{$servicio->nombre}}</h3>
    <p>
        {{$servicio->descripcion}}
    </p>
</div>
@endsection
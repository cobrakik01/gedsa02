@layout('client.main')

@section('menu')
<!--heredamos con parent lo que hay en la plantilla base pero añadimos otro elemento al menú-->
@parent
@endsection

@section('slider')
@endsection

@section('titulo_seccion')
    <h2>Nosotros</h2>
@endsection

@section('contenido')
<div class="article">
    <h3>Misión</h3>
    <div>
        Hacer realidad tus deseos de ampliacion remodelacion o construccion en tu vivienda.
    </div>
</div>

<div class="article">
    <h3 style="text-align: right;">Visión</h3>
    <div>
        Nos aaptamos a tus necesidaes de todo tipo.
    </div>
</div>

<div class="article">
    <h3>Objetivos</h3>
    <div>
        Poder hacer realidad lo que siempre soñaste de tu vivienda.
    </div>
</div>
@endsection
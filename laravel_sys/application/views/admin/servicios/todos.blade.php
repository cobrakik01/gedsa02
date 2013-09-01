@layout('admin.servicios.main')

@section('menu_servicios')
    @parent
@endsection

@section('contenido_servicios')
<div style="overflow: hidden;">
    <div style="font-size: 12px; float: right;">
        @if($servicios->total == 1)
            {{$servicios->total}} Servicio disponible
        @elseif($servicios->total > 1)
            {{$servicios->total}} Servicios disponibles
        @else
            <strong>No hay servicios disponibles</strong>
        @endif
    </div>
</div>
<h3>Todos los servicio</h3>
<div>
    @if($errors->first('errores'))
    <div class="message warning" style="margin-bottom: 10px;">
        {{$errors->first('errores')}}
    </div>
    @endif
    
    @if($servicios->total > 0)
    <table class="tresult" width='100%'>
        <tr>
            <th width='150px'>
                Nombre
            </th>
            <th>
                Descripción
            </th>
            <th width='100px'>
                Accion
            </th>
        </tr>
        @foreach($servicios->results as $servicio)
        <tr>
            <td>
                <div>
                    {{HTML::link('admin/servicios/ver/' . base64_encode($servicio->nombre),$servicio->nombre)}}
                </div>
                <div style="font-size: 9px;">
                    {{$servicio->created_at}}
                </div>
            </td>
            <td>
                <div>
                    {{$servicio->descripcion()}} {{HTML::link('admin/servicios/ver/' . base64_encode($servicio->nombre), '[...]', 'ver más')}}
                </div>
            </td>
            <td align='center'>
                {{HTML::link('admin/servicios/ver/' . base64_encode($servicio->nombre),'Ver')}}
                {{HTML::link('admin/servicios/eliminar/' . base64_encode($servicio->nombre),'Eliminar')}}
            </td>
        </tr>
        @endforeach
    </table>
    <table align="center">
        <tr>
            <td>
                {{$servicios->links()}}
            </td>
        </tr>
    </table>
    @else
    <div class="message">
        Aún no hay servicios disponibles, crea el primer servicio dando click {{HTML::link('admin/servicios/nuevo', 'aquí')}} 
        o dando clic en la opción <strong>Nuevo servicio</strong> del menú de la izquierda.
    </div>
    @endif
</div>
@endsection
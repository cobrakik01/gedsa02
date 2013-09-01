@layout('admin.servicios.main')

@section('menu_servicios')
    @parent
@endsection

@section('contenido_servicios')
<div>
    {{Form::open('admin/servicios/buscar', 'GET')}}
    <div style="border-bottom: solid 1px #efefef; margin-bottom: 20px; overflow: hidden; padding-top: 10px; margin-top: 10px;">
        {{Form::label('txt', 'Buscar Servicio', array('style' => 'font-size: 20px; margin-right: 10px; float: left;'))}}
        {{Form::text('txt', Input::old('txt') ? Input::old('txt'): Input::get('txt'), array('style'=>'width: 65%; margin-right: 10px; float: left;'))}}
        {{Form::submit('buscar', array('style'=>'float: left; position: relative; top: -6px;'))}}
    </div>
    <div style="">
        Filtros
        <select name="filtro" style="width: 600px;">
            <option value="0" <?php echo ($filtro == 0) ? 'selected="selected"': ""; ?>>[Opciones de busqueda]</option>
            <option value="1" <?php echo ($filtro == 1) ? 'selected="selected"': ""; ?>>Todos</option>
            <option value="2" <?php echo ($filtro == 2) ? 'selected="selected"': ""; ?>>Por usuario/administrador</option>
            <option value="3" <?php echo ($filtro == 3) ? 'selected="selected"': ""; ?>>Por nombre de servicio</option>
            <option value="4" <?php echo ($filtro == 4) ? 'selected="selected"': ""; ?>>Por fecha de publicación [aaaa-mm-dd]</option>
        </select>
    </div>
    {{Form::close()}}
</div>

@if($errors->first('errores'))
<div class="message warning" style="margin-top: 10px;">
    {{$errors->first('errores')}}
</div>
@endif

<div style="margin-top: 20px;">
    @if($servicios->total > 0)
    <div style="font-size: 12px; text-align: center; margin-bottom: 10px;">
        @if($servicios->total == 1)
            {{$servicios->total}} servicio encontrado
        @elseif($servicios->total > 1)
            {{$servicios->total}} servicios encontrados
        @endif
    </div>
    
    <table class="tresult" width="100%">
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
                {{$servicios->appends(array('txt' => Input::get('txt'), 'filtro' => $filtro))->links()}}
            </td>
        </tr>
    </table>
    @else
    <div class="message">
        No hay servicios disponibles.
    </div>
    @endif
</div>
@endsection
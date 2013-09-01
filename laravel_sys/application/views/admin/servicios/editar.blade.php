@layout('admin.servicios.main')

@section('menu_servicios')
    @parent
@endsection

@section('contenido_servicios')
    @if($errors->first('errores'))
    <div class="warning">
        {{$errors->first('errores')}}
    </div>
    @endif
    {{Form::open()}}
    <div style="border-bottom: solid 1px #efefef; margin-bottom: 20px;">
        {{Form::label('nombre', 'Nombre de Servicio', array('style' => 'font-size: 20px;'))}}
        {{Form::text('nombre', Input::old('nombre') ? Input::old('nombre'): $servicio->nombre, array('style'=>'width: 70%; margin-top: 20px; margin-bottom: 10px;'))}}
    </div>
    <div style="text-align: center;">
        {{Form::label('descripcion', 'Descripción')}}
    </div>
    <div>
        {{Form::textarea('descripcion', Input::old('descripcion') ? Input::old('descripcion'): $servicio->descripcion)}}
    </div>
    <div style="margin-top: 20px;">
        {{Form::submit('Guardar cambios', array('style' => 'float: right;'))}}
    </div>
    {{Form::hidden('old_nombre', base64_encode($servicio->nombre))}}
    {{Form::close()}}
@endsection
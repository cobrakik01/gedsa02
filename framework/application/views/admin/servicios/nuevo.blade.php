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
        {{Form::label('nombre', 'Nuevo Servicio', array('style' => 'font-size: 20px;'))}}
        {{Form::text('nombre', '', array('style'=>'width: 75%; margin-top: 20px; margin-bottom: 10px;'))}}
    </div>
    <div style="text-align: center;">
        {{Form::label('descripcion', 'Descripción')}}
    </div>
    <div>
        {{Form::textarea('descripcion', Input::old('descripcion'))}}
    </div>
    <div>
        {{Form::submit('Crear Servicio', array('style' => 'float: right;'))}}
    </div>
    {{Form::close()}}
@endsection
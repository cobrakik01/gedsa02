@layout('admin.presentaciones.main')

@section('menu_albums')
    @parent
@endsection

@section('menu_items_albums')
    @parent
@endsection

@section('contenido_albums')
    <h3>
        Se editara la descripción de la presentación <span style="font-weight: bold;">{{$presentacion->nombre}}</span>
    </h3>
    {{Form::open()}}
        <table align='center'>
            <tr>
                <td>
                    {{Form::label('descripcion','Descripcion')}}
                </td>
                <td>
                    {{Form::text('descripcion', $presentacion->descripcion)}}
                </td>
                <td style="padding-left: 10px;">
                    {{Form::submit('cambiar')}}
                </td>
            </tr>
        </table>
        {{Form::hidden('name', $presentacion->nombre)}}
        {{Form::hidden('admin_id', $presentacion->administradores_id)}}
        
        @if($errors->first('errrores'))
            <div class="warning">
                {{$errors->first('errrores')}}
            </div>
        @endif
    {{Form::close()}}
@endsection
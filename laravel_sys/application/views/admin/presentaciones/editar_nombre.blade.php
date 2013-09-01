@layout('admin.presentaciones.main')

@section('menu_albums')
    @parent
@endsection

@section('menu_items_albums')
    @parent
@endsection

@section('contenido_albums')
    <h3>
        Se editara el nombre de la presentación <span style="font-weight: bold;">{{$presentacion->nombre}}</span>
    </h3>
    {{Form::open()}}
        <table align='center'>
            <tr>
                <td>
                    {{Form::label('new_name','Nuevo Nombre')}}
                </td>
                <td>
                    {{Form::text('new_name')}}
                </td>
                <td style="padding-left: 10px;">
                    {{Form::submit('cambiar')}}
                </td>
            </tr>
        </table>
        {{Form::hidden('old_name', $presentacion->nombre)}}
        {{Form::hidden('admin_id', $presentacion->administradores_id)}}
        
        @if($errors->first('errrores'))
            <div class="warning">
                {{$errors->first('errrores')}}
            </div>
        @endif
    {{Form::close()}}
@endsection
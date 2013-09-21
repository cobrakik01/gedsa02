@layout('admin.albums.main')

@section('menu_albums')
@parent
@endsection

@section('menu_items_albums')
@parent
@endsection

@section('contenido_albums')
    <div class="message" style="margin-bottom: 50px; margin-top: 10px;">
        @if(!$fotos->results)
        <div class="title-message">
            <h4>Este álbum aún no tiene fotos, empieza subiendo la primera foto de este álbum.</h4>
        </div>
        @endif
        <div>
            {{Form::open_for_files('admin/albumes/subir_foto/')}}
            <table align="center" border="0">
                <tr>
                    <td align="right">{{ Form::label('nombre','Nombre') }}</td>
                    <td align="left">{{ Form::text('nombre', Input::old('nombre')) }}</td>
                    <td>{{ Form::label('nombre_archivo','Usar nombre de archivo', array('title'=>'Si la casilla esta seleccionada se usara el nombre original del archivo como nombre de la foto.', 'style'=>'margin-left: 10px;')) }} {{ Form::checkbox('nombre_archivo', 1, true) }}</td>
                    <td>
                        @if($errors->first('nombre'))
                        <div class="warning"> 
                            {{$errors->first('nombre')}}
                        </div>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td align="right">{{ Form::label('descripcion','Descripción') }}</td>
                    <td colspan="3" align="left">{{ Form::text('descripcion', Input::old('descripcion')) }}</td>
                </tr>
                <tr>
                    <td>{{Form::label('foto','Selecciona una foto')}}</td>
                    <td>{{ Form::file('foto') }}</td>
                    <td colspan="2">
                        @if($errors->first('foto'))
                        <div class="warning"> 
                            {{$errors->first('foto')}}
                        </div>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td colspan="3">{{Form::submit('Subir Foto')}}</td>
                </tr>
            </table>
            {{ Form::hidden('nombre_album', $album->nombre) }}
            {{Form::close()}}
        </div>
        <div>
            Solo se pueden subir fotos menores o iguales a 2 megabytes
        </div>
        @if($errors->first('errores'))
        <div class="warning">
            {{$errors->first('errores')}}
        </div>
        @endif
    </div>
    
    <div style="text-align: right;">
        {{ HTML::link('admin/albumes/cambiar_nombre_descripcion/' . AlbumController::toDir($album),'Cambiar nombre y/o descripción.') }}
    </div>
    <h3>
        Fotos del Album <em>"{{$album->nombre}}"</em>
        <span style="font-size: 13px; position: relative; top: -20px; left: -100px;">{{$fotos->total}} Fotos encontradas</span>
    </h3>
    <div style="padding: 10px; margin-bottom: 20px;">
        {{$album->descripcion}}
    </div>
    @if($fotos->results)
        <div class="wraper-photo">
            <ul>
                @foreach($fotos->results as $foto)
                    <li>
                        <div class="container-photo">
                            {{ HTML::image($foto->url, $foto->nombre, array('border'=>'0')) }}
                        <ul class="controls-photo">
                            <li>
                                {{HTML::link('admin/albumes/editar_foto/' . $foto->id,'', array('class'=>'btnEditControl', 'title'=>'Editar Foto'))}}
                            </li>
                            <li>
                                {{HTML::link('admin/albumes/eliminar_foto/' . $foto->id,'', array('class'=>'btnDeleteControl', 'title'=>'Eliminar Foto'))}}
                            </li>
                            </ul>
                            <div class="description-photo-bg"></div>
                            <div class="description-photo">
                                {{$foto->shortName()}}
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
        <table align='center'>
            <tr>
                <td>
                    {{$fotos->links()}}
                </td>
            </tr>
        </table>
    @endif
@endsection
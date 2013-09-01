@layout('admin.administradores.main')

@section('menu_admin')
    @parent
@endsection

@section('contenido_admin')
    <h3>{{$accion}}</h3>
    
    @if($users->results)
    <table class="tresult" width='100%' align="center">
        <tr>
            <th width='30px'>ID</th>
            <th>Nombre</th>
            <th width='100px'>Activo</th>
            <th width='180px'>Acción</th>
        </tr>
        @foreach($users->results as $us)
        <tr>
            <td align='center'>
            {{$us->id}}
            </td>
            <td>
            {{$us->nombre}}
            </td>
            <td align='center'>
            @if($us->activo)
                Si
            @else
                No
            @endif
            </td>
            <td align='center'>
                {{HTML::link('admin/administradores/ver/' . base64_encode($us->id),'Ver')}}
                @if($us->activo)
                {{HTML::link('admin/administradores/desactivar/' . base64_encode($us->id),'Desactivar')}}
                @else
                {{HTML::link('admin/administradores/activar/' . base64_encode($us->id),'Activar')}}
                @endif
                
                {{HTML::link('admin/administradores/editar/' . base64_encode($us->id),'Editar')}}
                {{HTML::link('admin/administradores/eliminar/' . base64_encode($us->id),'Eliminar')}}
            </td>
        </tr>
        @endforeach
    </table>
    @else
    <table align="center">
        <tr>
            <td>
                <h3>No se encontraron registros</h3>
            </td>
        </tr>
    </table>
    @endif
    {{$users->links()}}
@endsection
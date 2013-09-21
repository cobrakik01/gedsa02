@layout('admin.main')

@section('menu')
@parent
@endsection

@section('contenido')
Bienvenido <strong>{{HTML::span($user->nombre, array('style' => 'font-size: 20px;'))}}</strong> {{HTML::link('admin/administradores/ver/' . base64_encode($user->id),'Editar')}}
<hr />
<p>
    Nombre: {{$us_desc->nombre . ' ' . $us_desc->apellido_paterno . ' ' . $us_desc->apellido_materno}} <br />
    Direccion: {{$us_desc->direccion}} <br />
    Telefono: {{$us_desc->telefono}} <br />
    E-Mail: {{$us_desc->email}}
</p>
@endsection

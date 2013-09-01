@layout('admin.main')

@section('menu')
@parent
@endsection

@section('contenido')
<div class="message">
    <div class="title-message">{{$msg}}</div>
</div>
@endsection

@foreach ($clientes as $cliente)
    <div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3">
        <div class="profile-widget">
            <div class="profile-img">
                <a href="{{ route('clientes.show', $cliente->id) }}" class="avatar"><img
                        src="{{ asset('imgs/clientes/' . $cliente->foto) }}" alt="Foto"></a>
            </div>
            <div class="dropdown profile-action">
                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i
                        class="material-icons">more_vert</i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="#" data-toggle="modal"
                        data-target="#edit_cliente{{ $cliente->id }}"><i class="fa fa-edit m-r-5"></i> Editar</a>
                    <a class="dropdown-item" href="#" data-toggle="modal"
                        data-target="#delete_cliente{{ $cliente->id }}"><i class="fa fa-trash m-r-5"></i> Eliminar</a>
                </div>
            </div>
            <h4 class="user-name m-t-10 mb-0 text-ellipsis"><a
                    href="{{ route('clientes.show', $cliente->id) }}">{{ $cliente->nombre }}
                    {{ $cliente->apellidos }}</a></h4>
            <div class="small text-muted">{{ $cliente->empresa }}</div>
        </div>
    </div>
    @include('clientes.edit')
    @include('clientes.delete')
@endforeach

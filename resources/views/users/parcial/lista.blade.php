@foreach ($usuarios as $user)
    <div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3">
        <div class="profile-widget">
            <div class="profile-img">
                <a href="{{ route('users.show', $user->id) }}" class="avatar"><img
                        src="{{ asset('imgs/users/' . $user->user->foto) }}" alt="Foto"></a>
            </div>
            <div class="dropdown profile-action">
                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i
                        class="material-icons">more_vert</i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#edit_user{{ $user->id }}"><i
                            class="fa fa-edit m-r-5"></i> Editar</a>
                    <a class="dropdown-item" href="#" data-toggle="modal"
                        data-target="#delete_user{{ $user->id }}"><i class="fa fa-trash m-r-5"></i> Eliminar</a>
                </div>
            </div>
            <h4 class="user-name m-t-10 mb-0 text-ellipsis"><a
                    href="{{ route('users.show', $user->id) }}">{{ $user->nombre }} {{ $user->paterno }}
                    {{ $user->materno }}</a></h4>
            <div class="small text-muted">{{ $user->user->tipo }}</div>
        </div>
    </div>
    @include('users.edit')
    @include('users.delete')
@endforeach

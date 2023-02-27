@foreach ($actividads as $actividad)
    @php
        $completo = '';
        // PENDIENTE, COMPLETO
        if ($actividad->estado == 'COMPLETO') {
            $completo = 'completed';
        }
    @endphp
    <li class="{{ $completo }} task">
        <div class="task-container">
            <span class="task-action-btn task-check">
                <span class="action-circle large complete-btn" title="Completar tarea"
                    data-url="{{ route('actividads.update', $actividad->id) }}">
                    <i class="material-icons">check</i>
                </span>
            </span>
            <span class="task-label" contenteditable="true"
                data-url="{{ route('actividads.update', $actividad->id) }}">{{ $actividad->nombre }}</span>
            <span class="task-action-btn task-btn-right">
                <span class="action-circle large delete-btn" title="Eliminar tarea"
                    data-url="{{ route('actividads.destroy', $actividad->id) }}">
                    <i class="material-icons">delete</i>
                </span>
            </span>
        </div>
    </li>
@endforeach

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
            @if ($actividad->estado == 'COMPLETO')
                <span class="action-circle large informacion-btn" title="Formulario tarea"
                    data-url="{{ route('actividads.update2', $actividad->id) }}" data-nombre="{{ $actividad->nombre }}"
                    data-empresa="{{ $actividad->empresa_adjudicado }}" data-monto="{{ $actividad->monto }}"><i
                        class="fa fa-clipboard-list opcion"></i></span>
            @endif
            <span class="action-circle large delete-btn" title="Eliminar tarea"
                data-url="{{ route('actividads.destroy', $actividad->id) }}">
                <i class="material-icons">delete</i>
            </span>
        </span>

        {{-- iconos de informacion --}}
        <div class="contenedor_info_iconos">
            @if ($actividad->archivo && $actividad->estado == 'COMPLETO')
                <span class="info_actividad descargar"data-toggle="tooltip" title=""
                    data-original-title="Descargar" data-url="{{ route('actividads.descargar', $actividad->id) }}"><i
                        class="fa fa-paperclip"></i></span>
            @endif
            @if ($actividad->empresa_adjudicado && $actividad->empresa_adjudicado != '' && $actividad->estado == 'COMPLETO')
                <span class="info_actividad" data-toggle="tooltip" title=""
                    data-original-title="{{ $actividad->empresa_adjudicado }}"><i class="fa fa-building"></i></span>
            @endif
            @if ($actividad->monto && $actividad->monto != '' && $actividad->estado == 'COMPLETO')
                <span class="info_actividad" data-toggle="tooltip" title=""
                    data-original-title="{{ $actividad->monto }}"><i class="fa fa-money-bill"></i></span>
            @endif
        </div>
    </div>
</li>

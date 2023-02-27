
<input type="hidden" id="urlTipoAsistencia" value="{{route('asistencias.getHoraTipoEmpleado',Auth::user()->empleado->id)}}">

<input type="hidden" id="_i_e" value="{{Auth::user()->empleado->id}}">

<input type="hidden" id="urlStoreAsistencia" value={{route('asistencias.store')}}>

<div class="row">
    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
        <div class="card dash-widget">
            <div class="card-body">
                <span class="dash-widget-icon"><i class="fa fa-cubes"></i></span>
                <div class="dash-widget-info">
                    <h3>{{ $c_proyectos }}</h3>
                    <span>Proyectos</span>
                </div>
            </div>
        </div>
    </div>
</div>  
<!-- Edit proyecto Modal -->
<div id="modal_info_actividad" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Información adicional - <span id="txt_nombre_tarea"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Archivo </label>
                            <input type="file" name="archivo" id="archivo_actividad" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Empresa adjudicado</label>
                            <input type="text" class="form-control" name="empresa_adjudicado" id="empresa_adjudicado"
                                value="">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Monto</label>
                            <input type="number" class="form-control" name="monto" id="monto" value="">
                        </div>
                    </div>
                </div>
                <div class="row btnActualizaProyectoEdit">
                    <div class="col-md-12">
                        <div class="submit-section">
                            <button class="btn btn-primary submit-btn" id="btnEnvioInfoActividad"><i
                                    class="fa fa-spin"></i>Actualizar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Edit proyecto Modal -->

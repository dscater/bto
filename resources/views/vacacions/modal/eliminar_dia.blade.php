<!-- Delete sueldo Modal -->
<div class="modal custom-modal fade" id="modal_elimina_dia" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-header">
                    <h3>Eliminar Registro</h3>
                    <p>¿Estás seguro(a) de eliminar este registro?</p>
                    <h4 id="txtFechaVacacionEliminar" style="text-align:center;"></h4>
                </div>
                <div class="modal-btn delete-action">
                    <div class="row">
                        <div class="col-6">
                            <form method="POST" action="">
                                <button class="btn btn-primary continue-btn btn-block" type="button" id="btnConfirmaEliminarDia"> Si, eliminar</button>
                            </form>
                        </div>
                        <div class="col-6">
                            <a href="javascript:void(0);" data-dismiss="modal"
                                class="btn btn-primary cancel-btn">Cancelar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

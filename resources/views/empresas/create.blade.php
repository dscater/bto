<!-- Add empresa Modal -->
<div id="add_empresa" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Añadir Empresa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form data-toggle="validator" role="form" action="{{ route('empresas.store') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Nombre Empresa <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name='nombre' value="{{old('nombre')}}" required>
                            </div>
                        </div>

						<div class="col-sm-6">
                            <div class="form-group">
                                <label>Descripción</label>
                                <input class="form-control" type="text" name="descripcion" value="{{old('descripcion')}}">
                            </div>
                        </div>

						<div class="col-sm-12">
							<div class="submit-section">
								<button class="btn btn-primary submit-btn" type="submit"><i class="fa fa-save"></i>	Guardar</button>
							</div>
						</div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Add empresa Modal -->

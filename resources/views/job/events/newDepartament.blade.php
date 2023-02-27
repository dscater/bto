<div id="CreateDepartament" class="modal custom-modal fade" role="dialog">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Create Departament</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
  <div class="modal-body">
    <form action="{{ route('departament.store') }}" method="post">
          @csrf
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label align="height">Event Tittle</label>
                <input type="text" class="form-control" name="display_name" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Description of the event</label>
                <input type="text" class="form-control" name="description" required>
              </div>
            </div>
          </div>
          <div class="submit-section">
              <button class="btn btn-primary submit-btn" type="submit">Save</button>
          </div>
    </form>
  </div>
		</div>
	</div>
</div>

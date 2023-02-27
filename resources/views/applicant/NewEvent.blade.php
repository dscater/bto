{{--CREA UN NUEVO EVENTO CON UN APLICANTE Y TRABAJO DEFINIDO --}}
<div id="CreateEvent{{$applicant->id}}" class="modal custom-modal fade" role="dialog">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Create Event</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body" align="center">
          <form action="{{ route('applicant.newEvent') }}" method="post">
            @csrf
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label align="height"> Applicante</label>
											<select class="select" name="user_id">
											<option value='{{$applicant->user_id}}'>{{$applicant->name}}</option>
										</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label align="height"> Applicant</label>
									<label>Department</label>
											<select class="select" name="job_id">
											<option value='{{$applicant->job_id}}'>{{ $applicant->job_title }}</option>
										</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label align="height">Event Tittle</label>
		              <input type="text" class="form-control" name="titulo" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Description of the event</label>
		              <input type="text" class="form-control" name="descripcion" required>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Date</label>
		              <input type="date" class="form-control" name="fecha" required>
								</div>
							</div>
					</div>
            <br>
            <div class="submit-section">
              <button class="btn btn-primary submit-btn" type="submit">Save</button>
            </div>
          </form>
        </div>
			</div>
		</div>
	</div>
</div>

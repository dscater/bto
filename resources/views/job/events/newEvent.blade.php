
{{-- CREA UN NUEVO EVENTO CON TODOS LOS DATOS --}}
<div id="CreateEvent" class="modal custom-modal fade" role="dialog">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Create Event</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body" >
			<form action="{{ asset('Evento/newEvent') }}" method="post">
					@csrf
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label align="height"> Applicant</label>
									<select class="select" name="user_id">
									@foreach ($applicants as $applicant)
									<option value='{{$applicant->id}}'>{{ $applicant->name }}{{$applicant->last_name}}</option>
									@endforeach
								</select>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label align="height"> Departament</label>
									<select class="select" name="job_id">
									@foreach ($jobs as $job)
									<option value='{{$job->id}}'>{{ $job->display_name }}</option>
									@endforeach
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
					<div class="col-md-8">
            <div class="fomr-group">
              <label>Date</label>
              <input type="date" class="form-control" name="fecha" required>
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

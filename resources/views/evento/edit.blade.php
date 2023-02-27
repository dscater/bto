<!-- Edit Job Modal -->
<div id="edit_event{{$event->id}}" class="modal custom-modal fade" role="dialog">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Event</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <FORM method="POST" action="{{ route ('event.update',  $event->id) }}">
        	{!! method_field('PUT') !!}
          {!!csrf_field()!!}
          @if(isset($event->user_id ))
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Applicant Name</label>
                <input class="form-control" type="text" name="user_name" disabled value="{{ $event->user->name}}" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Job Title</label>
                <input class="form-control" type="text" name="job_title" disabled value="{{$event->job->job_title}}" required>
              </div>
            </div>
          </div>
        @endif


          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Event Title</label>
                <input class="form-control" type="text" name="titulo" value="{{ $event->titulo}}" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Event Description</label>
                <input class="form-control" type="text" name="descripcion" value="{{$event->descripcion}}" required>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Event Fecha</label>
                <input type="date" class="form-control" name="fecha" value="{{$event->fecha}}" required>
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
<!-- /Edit Job Modal -->

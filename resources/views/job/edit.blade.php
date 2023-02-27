<!-- Edit Job Modal -->
<div id="edit_job{{$job->id}}" class="modal custom-modal fade" role="dialog">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Job</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <FORM method="POST" action="{{ route ('job.update',  $job->id) }}">
        	{!! method_field('PUT') !!}
          {!!csrf_field()!!}
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Job Title</label>
                <input class="form-control" name="job_title" type="text" value="{{ $job->job_title}}r" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Department</label>
                <select class="select" name="job_department" required>
                  @foreach ($departaments as $departament)
                      <option @if( $job->departament_id==$departament->id) selected @endif value='{{ $departament->id}}'>{{ $departament->display_name}}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Job Location</label>
                <input class="form-control" type="text" name="job_location" value="{{ $job->job_location}}" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>No of Vacancies</label>
                <input class="form-control" type="number" name="num_vacancies" value="{{$job->num_vacancies}}" required>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Salary From</label>
                <input type="text" class="form-control" name="salary_from" value="{{$job->salary_from}}" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Salary To</label>
                <input type="number" class="form-control" name="salary_to" required value="{{$job->salary_to}}" required>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Job Type</label>
                <select class="select"  name="type_job" required>
                  <option @if( $job->type_job=="Full Time") selected @endif>Full Time</option>
                  <option @if( $job->type_job=="Part Timee") selected @endif>Part Time</option>
                  <option @if( $job->type_job=="Internship") selected @endif>Internship</option>
                  <option @if( $job->type_job=="Temporary") selected @endif>Temporary</option>
                  <option @if( $job->type_job=="Remote") selected @endif>Remote</option>
                  <option @if( $job->type_job=="Others") selected @endif>Others</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Status</label>
                <select class="select" name="status" required>
                  <option @if( $job->status=="Open") selected @endif>Open</option>
                  <option @if( $job->status=="Closed") selected @endif>Closed</option>
                  <option @if( $job->status=="Cancelled") selected @endif>Cancelled</option>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Start Date</label>

                <input type="text" id="start_date" name="start_date"  class="form-control datetimepicker"   value="  {{ date('d/m/Y', strtotime($job->start_date))}}"  required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Expired Date</label>
                <input type="text"  id="experied_date" name="experied_date"  class="form-control datetimepicker" value=" {{ date('d/m/Y', strtotime($job->experied_date))}}" required>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Experience</label>
                <input class="form-control" type="number"   name="experience" value="{{ $job->experience}}" required>
              </div>
            </div>

          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Description</label>
                <textarea class="form-control" name="description" required> {{$job->description}}</textarea>
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

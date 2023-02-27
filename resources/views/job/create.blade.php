<!-- Add Job Modal -->
<div id="add_job" class="modal custom-modal fade" role="dialog">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Job</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form action="{{ route('job.store') }}" method="post">
          {{ csrf_field() }}

          <div class="row">
            <div class="col-md-6">
              <div class="form-group" >
                <label>Job Title</label>
                <input class="form-control" type="text" name="job_title" required>
                {!! $errors->first('job_title','<span class="help">:message</span') !!}
              </div>
            </div>


            <div class="col-md-6">
            <div class="form-group">
              <label>Department</label>
                <label>Role</label>
               fsf <select class="select" name="departament_id">
                  @foreach ($departaments as $departament)
                  <option value='{{ $departament->id}}'>{{ $departament->display_name}}</option>
                  @endforeach
                </select>
              {!! $errors->first('job_department','<span class="help">:message</span') !!}
            </div>
          </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Job Location</label>
                <input class="form-control" type="text" name="job_location" required>
                {!! $errors->first('job_location','<span class="help">:message</span') !!}
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>No of Vacancies</label>
                <input class="form-control" type="number" name="num_vacancies" required>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Salary From</label>
                <input type="number" class="form-control" name="salary_from" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Salary To</label>
                <input type="number" class="form-control" name="salary_to" required>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Job Type</label>
                <select class="select" name="type_job" required>
                  <option>Full Time</option>
                  <option >Part Time</option>
                  <option>Internship</option>
                  <option>Temporary</option>
                  <option>Remote</option>
                  <option>Others</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Status</label>
                <select class="select" name="status" required>
                  <option>Open</option>
                  <option>Closed </option>
                  <option>Cancelled </option>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group" required>
                <label>Start Date</label>
              <input type="text" id="start_date_create" name="start_date" class="form-control datetimepicker"   value=""  required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Expired Date</label>
               <input type="text"  id="experied_date_create" name="experied_date" class="form-control datetimepicker" value="" required>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Experience</label>
                <input class="form-control" type="number" name="experience" required>
              </div>
            </div>

          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Description</label>
                <textarea class="form-control" name="description" required></textarea>
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
<!-- /Add Job Modal -->

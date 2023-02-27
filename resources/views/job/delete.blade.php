<!-- Delete Job Modal -->
<div class="modal custom-modal fade" id="delete_job{{$job->id}}" role="dialog">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body">
        <div class="form-header">
          <h3>Delete Job</h3>
          <p>Are you sure want to delete?</p>
        </div>
        <div class="modal-btn delete-action">
          <div class="row">
            <div class="col-6">

              <form   method="POST" action="{{ route('job.destroy',$job->id) }}">
                  {!! method_field('DELETE') !!}
                  {{ csrf_field() }}
              <button  class="btn btn-primary continue-btn btn-block" type="submit"> Delete</button>
              </form>

            </div>
            <div class="col-6">
              <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /Delete Job Modal -->

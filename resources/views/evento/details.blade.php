<div id="Details{{$event->id}}" class="modal custom-modal fade" role="dialog" style="overflow-y: scroll;">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title">DETAILS</h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body" align="center">


	
          <div class="fomr-group">
						<h4>Title Event </h4>
            {{ $event->titulo }}
					</div><br>
					@if(isset($event->user_id) or isset($event->job_id))
					<div class="fomr-group">
						<h4>Applicant </h4>
						{{ $event->user->name }}
							</div><br>
					<div class="fomr-group">
						<h4>Title Job </h4>
						{{ $event->job->job_title }}
					</div><br>
				@endif
          <div class="fomr-group">
            <h4>Description Event </h4>
            {{ $event->descripcion }}
          </div><br>
          <div class="fomr-group">
            <h4>Date</h4>
            {{ $event->fecha }}
          </div>
          <br>


			</div>
		</div>
	</div>
</div>

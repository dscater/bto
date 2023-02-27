<div id="viewpdf{{$applicant->id}}" class="modal custom-modal fade" role="dialog">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">CV {{$applicant->name}}</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body" align="center">

	       <iframe width="700" height="500" src="{{asset('images/applicants')}}/{{$applicant->upload_cv}}" frameborder="0"></iframe>
			</div>
		</div>
	</div>
</div>

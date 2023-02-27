<!-- Add User Modal -->
<div id="add_user" class="modal custom-modal fade" role="dialog">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Sign up</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="{{ route('applicant.store')}}" method="post" enctype="multipart/form-data">
					{{ csrf_field() }}

					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label>First Name <span class="text-danger">*</span></label>
								<input class="form-control" type="text" name='name' required>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label>Last Name</label>
								<input class="form-control" type="text" name="last_name" required>
							</div>
						</div>

						<div class="col-sm-6">
							<div class="form-group">
								<label>Email <span class="text-danger">*</span></label>
								<input class="form-control" type="email" name="email" required>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label>Identity card<span class="text-danger" >*</span></label>
								<input class="form-control" type="number" name="ci" required>
							</div>
						</div>

						<div class="col-sm-6">
							<div class="form-group">
								<label>Phone </label>
								<input class="form-control" type="number" name="phone" required>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label>Role</label>
								<select class="select" name="role_id" required>
									<option value=3>Applicant</option>
								</select>
							</div>
						</div>

						<div class="col-sm-6">
							<div class="form-group">
								<label>Password</label>
								<input class="form-control" type="password" name="password" required>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label>Confirm Password</label>
								<input class="form-control" type="password" name="password_confirmation" required>
							</div>
						</div>

					<div class="col-sm-8">
							<label>Profile Picture</label>
							<div class="custom-file">
							<input type="file" class="custom-file-input" id="cv_upload" name ="picture" required>
							<label class="custom-file-label" for="cv_upload">Choose file</label>
						</div>
					</div>

				</div>
					<div class="submit-section">
						<button class="btn btn-primary submit-btn" type="submit">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="request-modal" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">&nbsp;&nbsp;New Request</h3>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <form id="request_form">
                <div class="modal-body">
                    <div class="form-group">
                        <div class="col-lg-12">
             	        	<label for="recipient-name" class="form-control-label">
                            	<div>Your Name:</div>
                	        </label>
                            <input type="text" class="form-control" placeholder="Full Name" name="request_name" id="request_name" maxlength="30" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-12">
                        	<label for="recipient-name" class="form-control-label">
                            	<div>Your Email:</div>
                        	</label>
                            <input type="email" class="form-control" placeholder="someone@example.com" name="request_emailid" id="request_emailid" maxlength="30" required>
                        </div>
                    </div>
                    <div class="form-group">
            	        <div class="col-lg-12">
                	        <label for="recipient-number" class="form-control-label">
                                <div>Mobile Number:</div>
                            </label>
                            <input type="number" class="form-control"  placeholder="10 digit mobile no." name="phonenumber" id="phonenumber" max="9999999999" required>
                        </div>
                    </div>  
                    <div class="form-group">
                        <div class="col-lg-12">
                        	<label for="recipient-name" class="form-control-label">
                            	<div>Gender:</div>
                        	</label>
                        	<label class="custom-control custom-radio">
                            	<input name="request_gender" value="male" type="radio" class="custom-control-input" required>
                            	<span class="custom-control-indicator"></span>
                            	<span class="custom-control-description">Male</span>
                        	</label>
                        	<label class="custom-control custom-radio">
                            	<input name="request_gender" value="female" type="radio" class="custom-control-input" required>
                            	<span class="custom-control-indicator"></span>
                            	<span class="custom-control-description">Female</span>
                        	</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary"  id="submit_request">Request</button>
                </div>
            </form> 
        </div>
    </div>
</div>
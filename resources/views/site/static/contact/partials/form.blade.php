		<!-- Start Contact Area -->
		<section class="main-contact-area pb-100">
			<div class="container">
				<div class="section-title">
					<h2>Write Us</h2>
				</div>

				<form id="contactForm">
					<div class="row">
						<div class="col-lg-6 col-sm-6">
							<div class="form-group">
								<label>Your Name</label>
								<input type="text" name="name" id="name" class="form-control" required data-error="Please enter your name">
								<div class="help-block with-errors"></div>
							</div>
						</div>

						<div class="col-lg-6 col-sm-6">
							<div class="form-group">
								<label>Your Email</label>
								<input type="email" name="email" id="email" class="form-control" required data-error="Please enter your email">
								<div class="help-block with-errors"></div>
							</div>
						</div>

						<div class="col-lg-6 col-sm-6">
							<div class="form-group">
								<label>Your Phone</label>
								<input type="text" name="phone_number" id="phone_number" required data-error="Please enter your number" class="form-control">
								<div class="help-block with-errors"></div>
							</div>
						</div>

						<div class="col-lg-6 col-sm-6">
							<div class="form-group">
								<label>Subject</label>
								<input type="text" name="msg_subject" id="msg_subject" class="form-control" required data-error="Please enter your subject">
								<div class="help-block with-errors"></div>
							</div>
						</div>

						<div class="col-12">
							<div class="form-group">
								<label>Your Message</label>
								<textarea name="message" class="form-control" id="message" cols="30" rows="8" required data-error="Write your message"></textarea>
								<div class="help-block with-errors"></div>
							</div>
						</div>

						<div class="col-lg-12 col-md-12">
							<div class="form-group checkboxs">
								<input type="checkbox" id="chb2">
								<p>
									Accept <a href="terms-conditions.html">Terms &amp; Conditions</a> And <a href="privacy-policy.html">Privacy Policy.</a>
								</p>
							</div>
						</div>

						<div class="col-lg-12 col-md-12">
							<button type="submit" class="default-btn">
								<span>Send Message</span>
							</button>
							<div id="msgSubmit" class="h3 text-center hidden"></div>
							<div class="clearfix"></div>
						</div>
					</div>
				</form>
			</div>
		</section>
		<!-- End Contact Area -->
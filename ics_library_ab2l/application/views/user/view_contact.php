<!-- This file view_contact.php is for viewing of the contact us page in 
the user side -->
<div id="fb-root"></div>
	<script>
		(function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s); js.id = id;
		js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
		fjs.parentNode.insertBefore(js, fjs);
		}
		(document, 'script', 'facebook-jssdk'));
	</script>

	<div id="main-body" class="site-body">
		<div class="site-center">
			<div class="cell body">
				<p class="tiny">CONTACT US</p>
			</div>
			<div class="cell">
				<div class="cell width-fill">
					<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d483.56441633916387!2d121.24189600000001!3d14.164568!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x499e53d76db9e952!2sInstitute+of+Computer+Science+(1st+floor)!5e0!3m2!1sen!2sph!4v1394933740153" width="100%" height="450" frameborder="0" style="border:0"></iframe>
				</div>
				<div class="col">
					<div class="col width-1of2 gradient">
						<div class="cell">
							<div class="cell">
								<h3 class="color-black">Contact Us</h3>
								<div class="cell justify">
									<h5>Address:</h5>
									<p class="color-black"> Institute of Computer Science, College Of Arts and Sciences, University of the Philippines Los Baños, College 4031, Laguna, Philippines</p>
								</div>
								<div class="cell justify">
									<h5>Phone(8:00-17:00 +8:00GMT):</h5>
									<p class="color-black">536-2313</p>
								</div>
								<!-- For display of the facebook page -->
								<div class="cell justify">
									<h5>Website:</h5>
									<p class="color-black"><a href="http://www.ics.uplb.edu.ph">www.ics.uplb.edu.ph</a></p>
									<h5>Facebook Page:</h5>
									<div class="fb-like" data-href="https://www.facebook.com/ICS.UPLB" data-layout="standard" data-action="recommend" data-show-faces="true" data-share="true"></div>
									</div>
								</div>
							</div>
						</div>
						<div class="col width-fill">
							<div class="cell">
								<div class="cell width-fill">
									<div class="cell">
										<div class="cell">
											<!-- Div to show the form that the user will answer  -->
											<h3 class="color-black">Email Us</h3>

											<form action="controller_contact/emailsender" method="POST" class="width-3of4">
											<div class="cell">
												<!-- For name with validation that it should be letters only -->
												<div class="col width-1of3">
													<label class="color-black" for="name">* Name:</label>
												</div>
												<div class="col width-fill">
													<input type="text" id="sender_name" name="sender_name" pattern="[A-ZÑ]{1}[a-zñ]*[\-]?[a-zñ]*[\.]?[\ ]?([A-ZÑ]{1}[a-z]*[\-]?[a-zñ]*[\.]?[\ ]?)*" oninvalid="setCustomValidity('Invalid Input: Must be capitalized alpha characters only.')" onchange="try{setCustomValidity('')}catch(e){}" required="required" class="width-1of1 background-white float-right"/>
												</div>
											</div>
												<!-- For email with validation -->
											<div class="cell">
												<div class="col width-1of3">
													<label class="color-black" for="email">* Email:</label>
												</div>
												<div class="col width-fill">
													<input type="text" id="sender_email" name="sender_email" required="required"  pattern="[A-Za-z][A-Za-z-0-9\._]{3,20}@[A-Za-z0-9]{3,8}\.[A-Za-z]{3,5}" oninvalid="setCustomValidity('Invalid Input: Must be name@domain.extension.')" onchange="try{setCustomValidity('')}catch(e){}" class="width-1of1 background-white float-right"/>
												</div>
											</div>
											<!-- For contact number -->
											<div class="cell">
												<div class="col width-1of3">
													<label class="color-black" for="contactnum">* Contact:</label>
												</div>
												<div class="col width-fill">
												
													<input type="text" id="contactnum" name="contactnum" pattern="[0]{1}[9]{1}[0-9]{9}"  oninvalid="setCustomValidity('Invalid Input: Must be 09-xxxxxxxxx.')" onchange="try{setCustomValidity('')}catch(e){}" required="required" class="width-1of1 background-white float-right"/>
												</div>
											</div>
											<!-- For the subject of the email -->
											<div class="cell">
												<div class="col width-1of3">
													<label class="color-black" for="subject">* Subject:</label>
												</div>
												<div class="col width-fill">
												
													<input type="text" id="subject" name="subject" pattern=".{1,50}"  oninvalid="setCustomValidity('Invalid Input: Must be up to 50 characters only.')" onchange="try{setCustomValidity('')}catch(e){}" class="width-1of1 background-white float-right"/>
												</div>
											</div>
											<!-- Email body -->
											<div class="cell">
												<div class="width-1of3">
													<label class="color-black" for="message">*Comments/Suggestion/Inquiries:</label>
												</div>
												<div class="col">
													<textarea name="message" rows="5" cols="50" required="required" oninvalid="setCustomValidity('Please leave some comments, suggestions or questions.')" onchange="try{setCustomValidity('')}catch(e){}" class="float-right width-5of6 background-white"></textarea>
												</div>
											</div>
											<!-- Submit button -->
											<div class="cell">
												<input type="submit" name="submit" class="float-right"/>
											</div>
											<div class="cell">
												<p class="tiny">* - required field</p>
											</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

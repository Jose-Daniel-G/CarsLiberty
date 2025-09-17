	<div class="contact" id="contact">
		<div class="container">

			<h3>Contact</h3>
			<div class="heading-underline"></div>

			<form class="contact_form" action="{{ route('message.landing_page') }}" method="POST">
				@csrf
				<div class="message">
					<div class="col-md-6 col-sm-6 grid_6 c1">
						<input type="email" class="form-input" id="email" name="email" placeholder="Email" required="" >
						<input type="text" class="form-input" id="title" name="title" placeholder="Title" required="" >
						<input type="number" class="form-input" id="phone" name="phone" placeholder="Phone" required="" >
					</div>

					<div class="col-md-6 col-sm-6 grid_6 c1">
						<textarea id="message" name="message" placeholder="Message" required=""></textarea>
					</div>
					<div class="clearfix"></div>

					<input type="submit" class="more_btn" value="Send Message">
				</div>
			</form>

		</div>
	</div>
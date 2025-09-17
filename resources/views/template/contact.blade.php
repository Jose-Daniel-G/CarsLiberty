	<div class="contact" id="contact">
		<div class="container">

			<h3>Contact</h3>
			<div class="heading-underline"></div>

			<form class="contact_form" action="{{ route('message') }}" method="POST">
				@csrf
				<div class="message">
					<div class="col-md-6 col-sm-6 grid_6 c1">
						<input type="text" class="text" id="title" name="title" placeholder="Title" required="" >
						<input type="text" class="text" id="name" name="name" placeholder="Name" required="" >
						<input type="text" class="text" id="email" name="email" placeholder="Email" required="" >
						<input type="text" class="text" id="phone" name="phone" placeholder="Phone" required="" >
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
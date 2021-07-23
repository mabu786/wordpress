<?php
	get_header();
	 the_post()
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<article id="post-the-page" class="hentry">

				<header class="entry-header">
					<h1 class="entry-title">Quote Form</h1>
				</header><!-- .entry-header -->

				<div class="entry-content">
					<span id='msg'></span>
					<form method="POST" id="quoteForm" action="">
						<div class="form-group row">
							<label for="fname" class="col-md-4 col-form-label text-md-right">First Name *</label>
							<div class="col-md-6">
								<input id="fname" type="text" class="form-control " name="fname" value="" required autocomplete="off" autofocus>
								
							</div>
						</div>
						<div class="form-group row">
							<label for="mname" class="col-md-4 col-form-label text-md-right">Middle Name</label>
							<div class="col-md-6">
								<input id="mname" type="text" class="form-control " name="mname" value="" autocomplete="off" autofocus>
								
							</div>
						</div>
						<div class="form-group row">
							<label for="lname" class="col-md-4 col-form-label text-md-right">Last Name *</label>
							<div class="col-md-6">
								<input id="lname" type="text" class="form-control " name="lname" value="" required autocomplete="off" autofocus>
								
							</div>
						</div>
						<div class="form-group row">
							<label for="stadd" class="col-md-4 col-form-label text-md-right">Street Address *</label>
							<div class="col-md-6">
								<textarea id="stadd" class="form-control " name="stadd" required autocomplete="off" autofocus>
								</textarea>
								
							</div>
						</div>
						<div class="form-group row">
							<label for="unit" class="col-md-4 col-form-label text-md-right">Unit #</label>
							<div class="col-md-6">
								<input id="unit" type="text" class="form-control " name="unit" value="" autocomplete="off" autofocus>
								
							</div>
						</div>
						<div class="form-group row">
							<label for="city" class="col-md-4 col-form-label text-md-right">City *</label>
							<div class="col-md-6">
								<input id="city" type="text" class="form-control " name="city" value="" required autocomplete="off" autofocus>
								
							</div>
						</div>
						<div class="form-group row">
							<label for="state" class="col-md-4 col-form-label text-md-right">State *</label>
							<div class="col-md-6">
								<select id='state' class="form-control " name="state" required autocomplete="off" autofocu>
									<option value=''>Please select state</option>
									<option value='AL'>Alabama</option>
									<option value='AK'>Alaska</option>
									<option value='AZ'>Arizona</option>
									<option value='AR'>Arkansas</option>
									<option value='CA'>California</option>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label for="zip" class="col-md-4 col-form-label text-md-right">Zip Code *</label>
							<div class="col-md-6">
								<input id="zip" type="text" class="form-control " name="zip" value="" required autocomplete="off" autofocus>
								
							</div>
						</div>
						<div class="form-group row">
							<label for="date_od_birth" class="col-md-4 col-form-label text-md-right">Date Of Birth *</label>
							<div class="col-md-6">
								<input id="date_od_birth" type="text" class="form-control " name="date_od_birth" value="" required autocomplete="off" autofocus>
								
							</div>
						</div>
						<div class="form-group row">
							<label for="phone" class="col-md-4 col-form-label text-md-right">Phone Number *</label>
							<div class="col-md-6">
								<input id="phone" type="text" class="form-control " name="phone" value="" required autocomplete="off" autofocus>
								
							</div>
						</div>
						<div class="form-group row">
							<label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address *</label>
							<div class="col-md-6">
								<input id="email" type="text" class="form-control " name="email" value="" required autocomplete="off" autofocus>
								
							</div>
						</div>
						 <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">
                           <button type="submit"  class="btn btn-primary">
                               Send Quote
                            </button>                       
                        </div>
                    </div>
					</form>

				</div>

			</article>

		</main><!-- .site-main -->
	</div><!-- .content-area -->
<script>
jQuery(document).ready(function (){
jQuery("#quoteForm").submit(function(e) {
		
		e.preventDefault(); 
		
		
		jQuery.ajax({
				url: '<?php echo site_url()."/wp-admin/admin-ajax.php"; ?>',
				type: 'post',
				dataType:'json',
				data: {
					
					'action': 'quote_form_submit', 
					'data':  jQuery(this).serialize()
				},
				success: function(response) {
					if(response.quote_premium){
						$("#quoteForm").hide();
						$("#msg").append('Quote Premium : '+response.quote_premium);
					}else{
						alert('Fail');return false;
					}
					
				}
			});
		
	});
});
</script>
<?php
	get_footer();
?>
@if(\Session::has('flash_message'))
<section class="content-header">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="alert alert-success">{{ \Session::get('flash_message') }}</div>
			</div>
		</div>
	</div>
</section>
@endif

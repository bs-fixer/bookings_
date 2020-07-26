
@section('message')
    @if(Session::has('message'))
		<p class="alert {{ Session::get('alert-class', 'alert-info') }}  alert-dismissible fade show">{{ Session::get('message') }}
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">×</span>
			</button>
		</p>
	@endif
@endsection
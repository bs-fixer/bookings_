@extends('layouts.app')

@section('content')

<div class="pd-ltr-20 xs-pd-20-10">
	@if(Session::has('message'))
	<p class="alert {{ Session::get('alert-class', 'alert-info') }}  alert-dismissible fade show">{{ Session::get('message') }}
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">×</span>
		</button>
	</p>
	@endif
	<div class="form_wrapper">
		{!! Form::open([ 'route' => ['business.store']]) !!}
			
			{!! Helper::wrapHtml('text_field', ['name'=>'title', 'label'=>'Title', 'value'=>'' ]) !!}
			{!! Helper::wrapHtml('textarea_field', ['name'=>'description', 'label'=>'Description', 'value'=>'' ]) !!}

			@foreach($days as $key => $day)
				<div class="form-group dayName" data-day = "{{ $day }}">
					<div class="row">
						<label class="col-sm-12 col-md-2 col-form-label">
							{{ Form::checkbox("working_days[$day]", $day , ['class' => 'working_days']) }}
							{{$day}}
							<br>
							{{ Form::checkbox("working_hours_check[$day]", $day , ['class' => 'working_hours_check']) }}
							Working Hours
						</label>

						<div class="col-sm-12 col-md-10">
							{!! Helper::wrapHtml('repeater_field', ['name'=>'', 'fields'=>
								Form::button('-',['class' => 'btn btn-danger removeBtn'] ).
								Form::time('', '', ['class' => 'col-md-5' , 'data-name' => "working_hours[$day][from][]" ]).
								Form::time('', '', ['class' => 'col-md-5' , 'data-name' => "working_hours[$day][to][]" ])
							]) !!}
						</div>
					</div>
				</div>
			@endforeach

			{!! Helper::wrapHtml('button_field', ['name'=>'Add Business']) !!}
		{!! Form::close() !!}

	</div>
</div>

@endsection
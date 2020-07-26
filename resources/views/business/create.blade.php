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
			<div class="form-group row">
				{{ Form::label('title', 'Title', ['class' => 'col-sm-12 col-md-2 col-form-label']) }}
				<div class="col-sm-12 col-md-10">
					{{ Form::text('title', Request::old('title'), ['placeholder' => 'Business Title.','class' => 'form-control']) }}
				</div>
			</div>

			<div class="form-group row">
				{{ Form::label('description', 'Description', ['class' => 'col-sm-12 col-md-2 col-form-label']) }}
				<div class="col-sm-12 col-md-10">
					{!! Form::textarea('description', null, ['class'=>'form-control']) !!}
				</div>
			</div>

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
							<div class="repeater-wrap">
								{{ Form::button('+',['class' => 'btn btn-success addBtn'] )  }}
								<div class="repeater-container">
									<div class="repeater-fields repeater-to-clone">
										{{ Form::button('-',['class' => 'btn btn-danger removeBtn'] )  }}
										{{ Form::time('', '', ['class' => 'col-md-5' , 'data-name' => "working_hours[$day][from][]" ]) }}
										{{ Form::time('', '', ['class' => 'col-md-5' , 'data-name' => "working_hours[$day][to][]" ]) }}
									</div>
								</div>
							</div> <!-- repeater wrap ends -->
						</div>
					</div>
				</div>
			@endforeach

			<div class="form-group row">
			{{ Form::submit('Add Business' , ['class' => 'btn btn-primary'])}}
			</div>
		{!! Form::close() !!}

	</div>
</div>

@endsection
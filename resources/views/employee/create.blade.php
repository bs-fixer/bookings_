@extends('layouts.app')

@section('content')
	<div class="form_wrapper">
		{!! Form::open([ 'route' => ['employee.store' , $business_id ]]) !!}
			<div class="form-group row">
				{{ Form::label('business_id', 'Business Id', ['class' => 'col-sm-12 col-md-2 col-form-label']) }}
				<div class="col-sm-12 col-md-10">
					{{ Form::text('business_id', $business_id, ['class' => 'form-control']) }}
				</div>
			</div>

			<div class="form-group row">
				{{ Form::label('employee_name', 'Employee Name', ['class' => 'col-sm-12 col-md-2 col-form-label']) }}
				<div class="col-sm-12 col-md-10">
					{{ Form::text('name', '', ['placeholder'=>'Employee Name..','class' => 'form-control']) }}
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-12 col-md-2 col-form-label">Select Services</label>
				<div class="col-sm-12 col-md-10">
					<select name="services" class="custom-select2 form-control select2-hidden-accessible" multiple="" style="width: 100%;" tabindex="-1" aria-hidden="true">
						<optgroup label="services">
							@foreach($services as $service)
								<option value="{{ $service->id }}">{{ $service->name }}</option>
							@endforeach						
						</optgroup>
					</select>
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
				{{ Form::submit('Submit' , ['class' => 'btn btn-primary'])}}
			</div>
		{!! Form::close() !!}
	</div>
@endsection
@extends('layouts.app')

@section('content')
<!-- <div class="pd-ltr-20 xs-pd-20-10"> -->
	<div class="form_wrapper">

		{!! Form::open([ 'route' => ['employee.update' , $business_id, $employee_id ]]) !!}
			<div class="form-group row">
				{{ Form::label('business_id', 'Business Id', ['class' => 'col-sm-12 col-md-2 col-form-label']) }}
				<div class="col-sm-12 col-md-10">
					{{ Form::text('business_id', $business_id, ['class' => 'form-control']) }}
				</div>
			</div>

			<div class="form-group row">
				{{ Form::label('employee_name', 'Employee Name', ['class' => 'col-sm-12 col-md-2 col-form-label']) }}
				<div class="col-sm-12 col-md-10">
					{{ Form::text('name', '', ['class' => 'form-control']) }}
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-12 col-md-2 col-form-label">Select Services</label>
				
				<div class="col-sm-12 col-md-10">
					<select name="services[]" class="custom-select2 form-control select2-hidden-accessible" multiple="" style="width: 100%;" tabindex="-1" aria-hidden="true">
						<optgroup label="services">
							@foreach($services_list as $key => $sl)
								<option value="{{ $sl->id }}" {{ (in_array($sl->id , $services)) ? 'selected' : '' }}>{{ $sl->name }}</option>
							@endforeach						
						</optgroup>
					</select>
				</div>
			</div>

			<div class="form-group row">
				{{ Form::submit('Update' , ['class' => 'btn btn-primary'])}}
			</div>
		{!! Form::close() !!}

		<form method="POST" action="{{ route('employee.update' , ['business_id' => $business_id , 'employee_id' => $employee_id]) }}">
			@csrf
			@method('PUT')
			<div class="form-group row">
				<label class="col-sm-12 col-md-2 col-form-label">Business Id</label>
				<div class="col-sm-12 col-md-10">
					<input class="form-control" type="text" value="{{ $business_id }}" name="business_id">
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-12 col-md-2 col-form-label">Employee Name</label>
				<div class="col-sm-12 col-md-10">
					<input class="form-control" type="text" value="{{ $employee->name }}" name="name">
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-12 col-md-2 col-form-label">Select Services</label>
				
				<div class="col-sm-12 col-md-10">
					<select name="services[]" class="custom-select2 form-control select2-hidden-accessible" multiple="" style="width: 100%;" tabindex="-1" aria-hidden="true">
						<optgroup label="services">
							@foreach($services_list as $key => $sl)
								<option value="{{ $sl->id }}" {{ (in_array($sl->id , $services)) ? 'selected' : '' }}>{{ $sl->name }}</option>
							@endforeach						
						</optgroup>
					</select>
				</div>
			</div>

			@foreach($days as $key => $day)
				<div class="form-group dayName" data-day = "{{ $day }}">
					<div class="row">
						<label class="col-sm-12 col-md-2 col-form-label">
							<input type="checkbox" class="working_days" name="working_days[{{ $day }}]" value="	{{$day}}">{{$day}}
							<br>

							<input type="checkbox" class="working_hours_check" name="working_hours_check[{{ $day }}]" value="{{$day}}">Working Hours
						</label>
						<div class="col-sm-12 col-md-10">

							<div class="repeater-wrap">

								<button type='button' class="btn btn-success addBtn">+</button>	
								<div class="repeater-container">
									<!-- <div class="repeater-to-clone"> -->
										@forelse($working_hours[$day]['from'] as $key => $from )
											<div class="repeater-fields">
												<button type='button' class='btn btn-danger removeBtn'>-</button>
													@php $to = $working_hours[$day]['to'][$key] @endphp
													<input class="col-md-5" type="time" value="{{ $from }}" data-name = 'working_hours[{{$day}}][from][]' name="working_hours[{{$day}}][from][]">

													<input class="col-md-5" type="time" value="{{ $to}}" data-name = 'working_hours[{{$day}}][to][]' name="working_hours[{{$day}}][to][]" >
											</div>
											@empty
											<div class="repeater-fields repeater-to-clone">
												<button type='button' class='btn btn-danger removeBtn'>-</button>
													@php $to = $working_hours[$day]['to'][$key] @endphp
													<input class="col-md-5" type="time" value="{{ $from }}" data-name = 'working_hours[{{$day}}][from][]' >

													<input class="col-md-5" type="time" value="{{ $to}}" data-name = 'working_hours[{{$day}}][to][]' >
											</div>
										@endforelse
									<!-- </div> -->
								</div>
							</div> <!-- repeater wrap ends -->
							
						</div>
					</div>
				</div>
			@endforeach

			<div class="form-group row">
				<button type="submit" class="btn btn-primary">Update</button>
			</div>
		</form>
	</div>
<!-- </div> -->
@endsection
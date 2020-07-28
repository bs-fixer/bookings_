@extends('layouts.app')

@section('content')
	<div class="form_wrapper">
		{!! Form::open([ 'route' => ['employee.store' , $business_id ]]) !!}
			
			{!! Helper::wrapHtml('text_field', ['name'=>'business_id', 'label'=>'Business Id', 'value'=>$business_id ]) !!}
			{!! Helper::wrapHtml('text_field', ['name'=>'name', 'label'=>'Employee Name', 'value'=>'' ]) !!}
			{!! Helper::wrapHtml('select_field', ['name'=>'services[]', 'label'=>'Select Services', 'values'=>$services , 'selected_value' => null ]) !!}

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

			{!! Helper::wrapHtml('button_field', ['name'=>'Add Emplooyee']) !!}
		{!! Form::close() !!}
	</div>
@endsection
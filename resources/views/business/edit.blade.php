@extends('layouts.app')

@section('content')

<div class="pd-ltr-20 xs-pd-20-10">
	<div class="form_wrapper">

		{!! Form::open([ 'route' => ['business.update', $business->id ], 'method' => 'PUT']) !!}

			{!! Helper::wrapHtml('text_field', ['name'=>'title', 'label'=>'Title', 'value'=>$business->title ]) !!}
			{!! Helper::wrapHtml('textarea_field', ['name'=>'description', 'label'=>'Description', 'value'=>$business->description ]) !!}
			
			@foreach($days as $key => $day)
				<div class="form-group dayName" data-day = "{{ $day }}">
					<div class="row">
						<!-- <label class="col-sm-12 col-md-2 col-form-label">
							{{ Form::checkbox("working_days[$day]", $day , ['class' => 'working_days']) }}
							{{$day}}
							<br>
							{{ Form::checkbox("working_hours_check[$day]", $day , ['class' => 'working_hours_check']) }}
							Working Hours
						</label> -->
						{!! Helper::wrapHtml('repeater_label' , [ 'working_days' => "working_days[$day]", 'working_hours' => "working_hours_check[$day]" , 'day' => $day]) !!}
						<div class="col-sm-12 col-md-10">

							<div class="repeater-wrap">
								{{ Form::button('+', ['class' => 'btn btn-success addBtn'] ) }}
								<div class="repeater-container">
									@forelse( $working_hours[$day] as $v )
											{!! Helper::wrapHtml('repeater_edit_field' , [ 'from_value' => $v['from'], 'to_value' => $v['to'], 'from_name' => "working_hours[$day][from][]", 'to_name' => "working_hours[$day][to][]" ]) !!}
										@empty 
										<!-- <div class="repeater-fields repeater-to-clone">
											{{ Form::button('-',['class' => 'btn btn-danger removeBtn'] )  }}
											{{ Form::time('', '', ['class' => 'col-md-5' , 'data-name' => "working_hours[$day][from][]" ]) }}
											{{ Form::time('', '', ['class' => 'col-md-5' , 'data-name' => "working_hours[$day][to][]"]) }}
										</div> -->
										{!! Helper::wrapHtml('repeater_edit_field' , [ 'from_value' => $v['from'], 'to_value' => $v['to'], 'from_name' => "", 'to_name' => "" ]) !!}
									@endforelse
								</div>
							</div> <!-- repeater wrap ends -->
							
						</div>
					</div>
				</div>
				
			@endforeach

			{!! Helper::wrapHtml('button_field', ['name'=>'Update']) !!}
		{!! Form::close() !!}

	</div>
</div>

@endsection
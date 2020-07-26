@extends('layouts.app')

@section('content')

<div class="pd-ltr-20 xs-pd-20-10">
	<div class="form_wrapper">

		{!! Form::open([ 'route' => ['business.update', $business->id ], 'method' => 'PUT']) !!}
			<div class="form-group row">
				{{ Form::label('title', 'Title', ['class' => 'col-sm-12 col-md-2 col-form-label']) }}	
				<div class="col-sm-12 col-md-10">
					{{ Form::text('title', $business->title, ['value' => $business->title ,'class' => 'form-control']) }}
				</div>
			</div>

			<div class="form-group row">
				{{ Form::label('description', 'Description', ['class' => 'col-sm-12 col-md-2 col-form-label']) }}
				<div class="col-sm-12 col-md-10">
					{!! Form::textarea('description', $business->description, ['class'=>'form-control']) !!}
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
								<button type='button' class="btn btn-success addBtn">+</button>	
								<div class="repeater-container">
									@forelse( $working_hours[$day] as $v )
										<div class="repeater-fields">
											{{ Form::button('-',['class' => 'btn btn-danger removeBtn'] )  }}
											{{ Form::time('', $v['from'], ['class' => 'col-md-5' , 'data-name' => "working_hours[$day][from][]",  'name' => "working_hours[$day][from][]" ]) }}
											{{ Form::time('', $v['to'], ['class' => 'col-md-5' , 'data-name' => "working_hours[$day][to][]",  'name' => "working_hours[$day][to][]" ]) }}
										</div>
										@empty 
										<div class="repeater-fields">
											{{ Form::button('-',['class' => 'btn btn-danger removeBtn'] )  }}
											{{ Form::time('', '', ['class' => 'col-md-5' , 'data-name' => "working_hours[$day][from][]" ]) }}
											{{ Form::time('', '', ['class' => 'col-md-5' , 'data-name' => "working_hours[$day][to][]"]) }}
										</div>
									@endforelse
								</div>
							</div> <!-- repeater wrap ends -->
							
						</div>
					</div>
				</div>
				
			@endforeach

			<div class="form-group row">
				{{ Form::submit('Update', ['class' => 'btn btn-primary']) }}
			</div>
		{!! Form::close() !!}

	</div>
</div>

@endsection
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
		<form method="POST" action="/business">
			@csrf
			<div class="form-group row">
				<label class="col-sm-12 col-md-2 col-form-label">Ttitle</label>
				<div class="col-sm-12 col-md-10">
					<input class="form-control" type="text" placeholder="Business Title.." name="title" value="{{ old('title') }}">
					@error('title')
					    <div class="alert alert-danger">{{ $message }}</div>
					@enderror
				</div>
			</div>
			
			<div class="form-group row">
				<label class="col-sm-12 col-md-2 col-form-label">Business Description</label>
				<div class="col-sm-12 col-md-10">
					<textarea name="description" class="form-control" ></textarea>
					@error('description')
					    <div class="alert alert-danger">{{ $message }}</div>
					@enderror
				</div>
			</div>

			<div class="form-group">
				<div class="row">
					<label class="col-sm-12 col-md-2 col-form-label">Default</label>
					<div class="col-sm-12 col-md-10">
						<button type='button' id='default_add' class="btn btn-success btn-md">+</button>
						<div class="default-parent">
							<div class="default-parent-keeper">
								<button type='button' class='btn btn-danger default_remove'>-</button>
								<input class="col-md-5 repeater_input" type="time" placeholder="From" name="working_hours[default][from][]">
								
								@if($errors->has('working_hours.default.from.0'))
                                    <div class="invalid-feedback">
                                        <p class="m-0">
                                            {{ $errors->first('working_hours.default.from.0') }}
                                        </p>
                                    </div>
                                @endif

								<input class="col-md-5 repeater_input" type="time" placeholder="To" name="working_hours[default][to][]">
								@if($errors->has('working_hours.default.to.0'))
                                    <div class="invalid-feedback">
                                        <p class="m-0">
                                            {{ $errors->first('working_hours.default.to.0') }}
                                        </p>
                                    </div>
                                @endif

							</div>
						</div>
					</div>
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
							<button type='button' class='btn btn-success addWorkingHours' class="btn btn-success btn-md">+</button>
							<div class="{{$day}}-parent">
								<div class="{{$day}}-parent-keeper workingHoursFields">
									
									@if(old('working_hours.'.$day.'.from'))
										<button type='button' class='btn btn-danger removeWorkingDays'>-</button>
										@foreach ( old('working_hours.'.$day.'.from') as $i => $arr )
											<input class="col-md-5 repeater_input" type="time" placeholder="From" name="working_hours[{{$day}}][from][]" value="{{ old('working_hours.'.$day.'.from.'.$i) }}">

											@if($errors->has('working_hours.'.$day.'.from.'.$i))
		                                        {{ $errors->first('working_hours.'.$day.'.from.'.$i) }}
		                                    @endif

										@endforeach
										
										@foreach ( old('working_hours.'.$day.'.to') as $i => $arr )
											<input class="col-md-5 repeater_input" type="time" placeholder="To" name="working_hours[{{$day}}][to][]" value="{{ old('working_hours.'.$day.'.to.'.$i) }}">

											@if($errors->has('working_hours.'.$day.'.to.'.$i))
		                                        {{ $errors->first('working_hours.'.$day.'.to.'.$i) }}
		                                    @endif
										@endforeach

									@else
									<button type='button' class='btn btn-danger removeWorkingDays'>-</button>
										<input class="col-md-5 repeater_input" type="time" placeholder="From" name="working_hours[{{$day}}][from][]">

										<input class="col-md-5 repeater_input" type="time" placeholder="To" name="working_hours[{{$day}}][to][]">

									@endif
								</div>
							</div>
						</div>
					</div>
				</div>
				
			@endforeach
			
			<div class="form-group row">
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
		</form>
	</div>
</div>


<!-- <div class="pd-ltr-20 xs-pd-20-10">
	<table id="table_id" class="display">
    <thead>
        <tr>
            <th>Serial No.</th>
            <th>Working Days</th>
            <th>Working Hours</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1</td>
            <td>Monday , Tuesday </td>
            <td>11 to 12 , 12 to 1 , 1 to 2</td>
        </tr>
    </tbody>
</table>
</div> -->
@endsection
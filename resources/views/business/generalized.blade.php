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

							<div class="repeater-wrap">

								<button type='button' class="btn btn-success addBtn">+</button>	
								<div class="repeater-container">
									<!-- <div class="repeater-to-clone"> -->
										<div class="repeater-fields repeater-to-clone">
											<button type='button' class='btn btn-danger removeBtn'>-</button>

											<input class="col-md-5" type="time" placeholder="From" data-name = 'working_hours[{{$day}}][from][]' >

											<input class="col-md-5" type="time" placeholder="From" data-name = 'working_hours[{{$day}}][to][]' >

										</div>
									<!-- </div> -->
								</div>
							</div> <!-- repeater wrap ends -->
							
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

@endsection
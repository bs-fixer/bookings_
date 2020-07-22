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
			<table id="myTable" class="display">
			    <thead>
			        <tr>
			            <th>Serial No.</th>
			            <th>Business Name</th>
			            <th>Modify</th>
			        </tr>
			    </thead>
			    <tbody>
			            
			    	@foreach( $business_list as $key => $bl )
			        <tr>
			            <td>{{ $bl->id }}</td>
			            <td>{{ $bl->title }}</td>
			            <td>
			            	
			            	<a href="{{ route('editBusiness' , ['business_id' => $bl->id]) }}" class="btn btn-success">
			            		<i class="fa fa-pencil" aria-hidden="true"></i>
							</a>

							<form method="POST" action="{{ route('deleteBusiness' , ['business_id' => $bl->id ] ) }}" style="float: left;margin-right: 5px;">
								@csrf
								@method('DELETE')
								<button onclick="confirm('Are you sure?')" class="btn btn-danger" type='submit'>
			            			<i class="fa fa-trash" aria-hidden="true"></i>
								</button>
							</form>
			            </td>
			        </tr>
			        @endforeach
			    </tbody>
			</table>
		</div>
	</div>
@endsection
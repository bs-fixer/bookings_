@extends('layouts.app')

@section('content')
	<div class="pd-ltr-20 xs-pd-20-10">
		@yield('notification.message')
		<div class="form_wrapper">
			<!-- {!! Helper::wrapHtml('table', 
										['th'		   => ['Serial No.' , 'Name', 'Modify'], 
										'tbody_record' => $business_list , 
										'id' 		   => 'e',
										'id1_name'	   => 'business_id',
										'id2_name'	   => 'e',
										'edit'		   => 'business.edit',
										'destroy' 	   => 'business.destroy'
										]
								) 
			!!} -->

			<!-- <table id="myTable" class="display">
				<thead>
					<tr>
						<th>Serial No.</th>
						<th>Name</th>
						<th>Modify</th>
					</tr>
				</thead>
				<tbody>
					@foreach( $business_list as $key => $bl )
					<tr>
						<td>{{ $bl->id }}</td>
						<td>{{ $bl->title }}</td>
						<td>
							{!! Helper::modifyButton( 
								['edit' => 'business.edit' , 'destroy' => 'business.destroy'] , 
								[ 
									'val1'  => $bl->id,
									'val2'  => ''
								] 
							) !!}
						</td>
					</tr>
					@endforeach
				</tbody>
			</table> -->


			@php
			$data = [];
			foreach($business_list as $bl){
				$data[] = [
					$bl->id,
					$bl->title,
					Helper::editBtn(['link'=> route('business.edit' , [$bl->id ] ) ]).
					Helper::destroyBtn(['link'=> route('business.destroy' , [$bl->id ] ) ]),
				];
			}
			
			@endphp
			
			{!! Helper::tableBase([
						'head' 	=> ['serial No', 'Name', 'Modify'],
						'body' => $data,
			]) !!}
			
		</div>
	</div>
@endsection
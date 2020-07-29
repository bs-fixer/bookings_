@extends('layouts.app')

@section('content')
	<div class="form_wrapper">
	<?php 
	// $yourarray = ['id', 'name', 'contact'];
	// echo '<table class="myTable display">';
	// 	echo '<tr>';
	// 	foreach($yourarray as $row){
			
	// 		// foreach($row as $key => $cell){
	// 			echo '<td>'.$row.'</td>';
	// 		// }
	// 	}
	// 	echo '</tr>';
	// 	$record = ['1','bakhtawar','0300'];
	// 	echo '<tr>';
	// 		foreach($record as $rec){
	// 			echo '<td>'.$rec.'</td>';
	// 		}
	// 	echo '</tr>';
	// echo '</table>';
	?>
		{!! Helper::wrapHtml('table',[
										'th' 	  => ['serial No.' , 'Name', 'Modify'], 
										'tbody_record' => $services , 
									    'id' 	  => $business_id, 
										'id1_name'=> 'business_id',
										'id2_name'=> 'service_id',
										'edit'	  => 'business.service.edit' , 
										'destroy' => 'business.service.destroy',
									]
							) 
		!!}
	</div>
@endsection

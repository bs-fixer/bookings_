<link rel="stylesheet" type="text/css" href="{{ url('/') }}/src/plugins/datatables/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="{{ url('/') }}/src/styles/bootstrap-datepicker.min.css">

<div class="form_wrapper">
    <div class="alert alert-success bookingByUserAlert" hidden>
        <strong>Success!</strong> Indicates a successful or positive action.
    </div>

    {!! Form::open([ 'route' => ['frontendbooking', $business_id] , 'id' => 'bookingByUser' ]) !!}
        {!! Helper::wrapHtml('text_field', ['name'=>'business_id', 'label'=>'Business ID', 'value'=>$business_id , 'selected_value' => null ]) !!}
        {!! Helper::wrapHtml('text_field', ['name'=>'name', 'label'=>'Name', 'value'=>'' , 'selected_value' => null ]) !!}
        {!! Helper::wrapHtml('text_field', ['name'=>'contact', 'label'=>'Contact', 'value'=>'' , 'selected_value' => null ]) !!}
        {!! Helper::wrapHtml('email_field', [
                                                'name' => 'email' , 'label' => 'Email' , 'value' => '' , 
                                                'attributes' => ['placeholder' => 'abc@email.com' , 'class'=>'form-control'] 
                                            ]) 
        !!}
        {!! Helper::wrapHtml('select_field', ['name'=>'ref_id', 'label'=>'Select Employees', 'values'=>$employees , 'selected_value' => null , 'multiple' => null ]) !!}
        {!! Helper::wrapHtml('select_field', ['name'=>'services', 'label'=>'Select Services', 'values'=>$services , 'selected_value' => null ,'multiple' => null ]) !!}
        {!! Helper::wrapHtml('datepicker_field', ['name'=>'dob', 'label'=>'Select Booking Day', 'value'=>null , 'selected_value' => null]) !!}
        <!-- {!! Helper::wrapHtml('date_field', ['name'=>'DOB', 'label'=>'Select Booking Day']) !!} -->
        <!-- <input name="somedate" type="date"> -->
        <div class="row bookings_slot"></div>
        {!! Helper::wrapHtml('button_field', [
                                                'value'=>'Add Booking', 
                                                'attributes' => ['type'=>'submit', 'name'=>'booking_btn', 'class'=>'btn btn-primary booking_btn'] 
                                            ]) !!}	
    {!! Form::close() !!}
</div>

<script src="{{ url('/') }}/src/scripts/js/jquery.min.js"></script>
<script src="{{ url('/') }}/src/scripts/js/bootstrap-datepicker.min.js"></script>
<script src="{{ url('/') }}/src/scripts/js/custom.js"></script>
<script src="{{ url('/') }}/src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
<script src="{{ url('/') }}/vendors/scripts/core.js"></script>
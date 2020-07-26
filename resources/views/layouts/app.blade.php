@include('notification.message')
<!DOCTYPE html>
<html>
<head>
	@include('includes_template.head')
	<link rel="stylesheet" type="text/css" href="{{ url('/') }}/src/plugins/datatables/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="{{ url('/') }}/src/plugins/datatables/css/responsive.bootstrap4.min.css">
	<!-- data table css cdn -->
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
	<link rel="stylesheet" type="text/css" href="{{ url('/') }}/src/styles/style.css">
</head>
<body>
	@include('includes_template.header')
	@include('includes_template.sidebar')
	<div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			@yield('message')
			@yield('content')
		</div>
	</div>
	@include('includes_template.script')
	<script src="{{ url('/') }}/src/plugins/apexcharts/apexcharts.min.js"></script>
	<script src="{{ url('/') }}/src/plugins/datatables/js/jquery.dataTables.min.js"></script>
	<script src="{{ url('/') }}/src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
	<script src="{{ url('/') }}/src/plugins/datatables/js/dataTables.responsive.min.js"></script>
	<script src="{{ url('/') }}/src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
	<script src="{{ url('/') }}/src/scripts/js/custom.js"></script>
	<!-- datatable js -->
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
</body>
</html>
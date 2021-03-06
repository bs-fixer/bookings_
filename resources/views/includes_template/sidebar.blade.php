	<div class="left-side-bar">
		<div class="brand-logo">
			<a href="index.php">
				<img src="{{ url('/') }}/vendors/images/deskapp-logo.svg" alt="" class="dark-logo">
				<img src="{{ url('/') }}/vendors/images/deskapp-logo-white.svg" alt="" class="light-logo">
			</a>
			<div class="close-sidebar" data-toggle="left-sidebar-close">
				<i class="ion-close-round"></i>
			</div>
		</div>
		<div class="menu-block customscroll">
			<div class="sidebar-menu">
				<ul id="accordion-menu">
					<li>
						<a href="{{ route('dashboard') }}" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-house-1"></span><span class="mtext">Dashboard</span>
						</a>
					</li>
					
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-house-1"></span><span class="mtext">Bookings</span>
						</a>
						<ul class="submenu">
							<li><a href="{{ route('business.bookings.index' , ['business_id' => 1] ) }}">Booking</a></li>
							<li><a href="{{ route('business.bookings.create' , ['business_id' => 1] ) }}">Add Booking</a></li>
						</ul>
					</li>

					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-house-1"></span><span class="mtext">Business</span>
						</a>
						<ul class="submenu">
							<li><a href="{{ route('business.index') }}">Business</a></li>
							<li><a href="{{ route('business.create') }}">Add Business</a></li>
						</ul>
					</li>

					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-house-1"></span><span class="mtext">Services</span>
						</a>
						<ul class="submenu">
							<li><a href="{{ route('business.service.index' , ['business_id' => 1]) }}" class="dropdown-toggle no-arrow">Services
							</a></li>
							<li><a href="{{ route('business.service.create' , ['business_id' => 1])}}">Add Service</a></li>
						</ul>
					</li>

					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-house-1"></span><span class="mtext">Employees</span>
						</a>
						<ul class="submenu">
							<li><a href="{{ route('employee.index' , ['business_id' => 1]) }}" class="dropdown-toggle no-arrow">Employees
						</a></li>
							<li><a href="{{ route('employee.create' , ['business_id' => 1] )}}">Add Employee</a></li>
						</ul>
					</li>

				</ul>
			</div>
		</div>
	</div>
	<div class="mobile-menu-overlay"></div>
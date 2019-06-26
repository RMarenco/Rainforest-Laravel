<<<<<<< HEAD
@if (Auth::guard('web')->check())
	<p style="color:green">
		You are Logged in as a <strong>USER</strong>
	</p>
@else
	<p style="color:red">
		You are Logged Out as a <strong>USER</strong>
	</p>
@endif

@if (Auth::guard('admin')->check())
	<p style="color:green">
		You are Logged in as a <strong>ADMIN</strong>
	</p>
@else
	<p style="color:red">
		You are Logged Out as a <strong>ADMIN</strong>
	</p>
=======
@if (Auth::guard('web')->check())
	<p style="color:green">
		You are Logged in as a <strong>USER</strong>
	</p>
@else
	<p style="color:red">
		You are Logged Out as a <strong>USER</strong>
	</p>
@endif

@if (Auth::guard('admin')->check())
	<p style="color:green">
		You are Logged in as a <strong>ADMIN</strong>
	</p>
@else
	<p style="color:red">
		You are Logged Out as a <strong>ADMIN</strong>
	</p>
>>>>>>> e9b1688eb66a870fc29e49895a1cba4c4c7bd269
@endif
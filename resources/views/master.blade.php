<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Book Management System</title>
	{{ Html::style('vendor/bootstrap/css/bootstrap.min.css') }}
	{{ Html::style('vendor/bootstrap/css/dashboard.css') }}
</head>
<body>

<nav class="navbar navbar-dark bg-inverse navbar-fixed-top">
	<a class="navbar-brand" href="#">BooksSystem</a>

	<div class="nav navbar-nav pull-xs-right">
		<a class="nav-item nav-link" href="#">My Profile</a>
		<a class="nav-item nav-link" href="#">Pricing</a>
		<a class="nav-item nav-link" href="#">About</a>
	</div>
</nav>

<div class="container-fluid">
	<div class="row">
		<div class="col-sm-1 col-md-1 sidebar">
			<ul class="nav nav-pills nav-stacked">
				<li class="nav-item">
					<a class="nav-link" href="#">Dashboard</a>
				</li>
				<li class="nav-item active">
					<a class="nav-link" href="#">Books</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">Reports</a>
				</li>
			</ul>
		</div>
		<div class="col-sm-11 col-sm-offset-1 col-md-11 col-md-offset-1 main">
			<h1 class="page-header">@yield('page_header')</h1>

			@yield('content')

		</div>
	</div>
</div>

</body>
</html>
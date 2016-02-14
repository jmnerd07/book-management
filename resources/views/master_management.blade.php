<!doctype html>
<html lang="en" data-ng-app="BookManagementApp">
<head>
	<meta charset="UTF-8">
	<title>Book Management System</title>
	{{ Html::style('vendor/bootstrap/css/bootstrap.min.css') }}
	{{ Html::style('vendor/bootstrap/css/dashboard.css') }}
	{{ Html::style('css/styles.css') }}
</head>
<body>

<nav class="navbar navbar-dark bg-inverse navbar-fixed-top">
	<a class="navbar-brand" href="#">Books System</a>

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
				<li class="nav-item active">
					<a class="nav-link" href="{{ route('books.home') }}">Books</a>
					<a class="nav-link" href="{{ route('genres.home') }}">Genres</a>
				</li>
			</ul>
		</div>
		<div class="col-sm-11 col-sm-offset-1 col-md-11 col-md-offset-1 main">
			<h1 class="page-header">@yield('page_header')</h1>

			@yield('content')

		</div>
	</div>
</div>

{{ Html::script('vendor/tether-1.1.1/dist/js/tether.min.js') }}
{{ Html::script('vendor/jquery/dist/jquery.min.js') }}
{{ Html::script('vendor/bootstrap/js/bootstrap.min.js') }}
{{ Html::script('vendor/react-0.14.6/JSXTransformer.js') }}
{{ Html::script('vendor/react-0.14.6/build/react.js') }}
{{ Html::script('vendor/react-0.14.6/build/react-dom.js') }}
{{ Html::script('vendor/angularjs/angular.js') }}
{{ Html::script('js/app.js') }}
@yield('user_js');
</body>
</html>
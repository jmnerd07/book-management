@extends('master')
@section("content")
	<h2 class="sub-header">Books</h2>
	@if(session('status'))
		<div class="alert alert-success alert-dismissible fade in" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
			{{ session('status')  }}
		</div>
	@endif
	<div class="pull-xs-right">{{ link_to_route('books.new', "Add new book", array(), ['class'=>"btn btn-primary btn-sm"])  }}</div>
	<div class="table-responsive">

		@unless($books->count())
			<p class="text-danger">No books found.</p>
			@else
				<div class="table-responsive">
					<table class="table table-hover">
						<thead class="thead-inverse">
						<tr>
							<th>Title</th>
							<th>Author</th>
							<th>Description</th>
						</tr>
						</thead>
						<tbody>
						@foreach($books as $book)
							<tr>
								<td>{{ $book->title }}</td>
								<td>{{ $book->author }}</td>
								<td>{{ $book->description }}</td>
							</tr>
						@endforeach
						</tbody>
					</table>
				</div>
				@endunless

	</div>
@stop
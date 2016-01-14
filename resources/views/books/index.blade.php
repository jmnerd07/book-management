@extends('master')
@section("content")
	<h2 class="sub-header">Books</h2>
	<div class="pull-right">{{ link_to_route('books.new', "Add new book", array(), ['class'=>"btn btn-primary btn-sm"])  }}</div>
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
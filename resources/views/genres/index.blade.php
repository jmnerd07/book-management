@extends('master_management')
@section("content")
	<div data-ng-controller="GenresController">
		<h2 class="sub-header">Genres</h2>
		@if(session("status"))
			<div class="alert alert-success alert-dismissible fade in" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				{{ session('status')  }}
			</div>
		@endif
		<div class="pull-xs-right">
			<button class="btn btn-primary btn-sm ng-create-new-genre" data-link-save-create="{{ route('genres.async.newGenre') }}" data-toggle="modal" data-target="#modal-box">Add new genre</button>
		</div>
		<div class="table-responsive">

			@unless($genres->count())
				<p class="text-danger">No genres found.</p>
			@else
				<div class="table-responsive">
					<table class="table table-hover">
						<thead class="thead-inverse">
						<tr>
							<th>Genre</th>
							<th>Description</th>
							<th></th>
						</tr>
						</thead>
						<tbody>
						@foreach($genres as $genre)
							<tr>
								<td>{{ $genre->name }}</td>
								<td>{{ $genre->description }}</td>
								<td>
									<div class="btn-group">
										<button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										</button>
										<div class="dropdown-menu">
											<a href="#" data-genre-id="{{$genre->id}}" data-toggle="modal" data-target="#modal-box" class="dropdown-item ng-button-edit-genre">Edit</a>
											<div class="dropdown-divider"></div>
											<a class="dropdown-item" href="#">Remove</a>
										</div>
									</div>
								</td>
							</tr>
						@endforeach
						</tbody>
						<tfoot>
							<tr>
								<td colspan="3"></td>
							</tr>
						</tfoot>
					</table>
				</div>
			@endunless
		</div>
	</div>
	@section('user_js')
		{{ Html::script('js/controllers/genres.controller.js') }}
		{{ Html::script('js/directives/genres-dom.directive.js') }}
	@endsection
@stop
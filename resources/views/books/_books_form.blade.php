@extends("master")

@section("content")
	<h2 class="sub-header">Books
		<small>- New Book</small>
	</h2>

	{{ Form::model($book, array('route'=>'books.save_new')) }}
	<fieldset>
		<div class="form-group row {{ ( $errors->has('submitted') ? ($errors->has('title') ? 'has-danger' : 'has-success') : '' )  }}">
			<label for="book-title" class="col-sm-2 form-control-label"><span class="text-danger">*</span> Book Title</label>
			<div class="col-sm-10">
				{{ Form::text("title", $book->title, ['class'=>'form-control'.( $errors->has('submitted') ? ($errors->has('title') ? ' form-control-danger' : ' form-control-success') : '' ),'id'=>'book-title', 'type'=>'text', 'placeholder'=>'Book Title']) }}
				@if($errors->has('title'))
					<small class="text-danger">{{ $errors->first('title')  }}</small>
				@endif
			</div>
		</div>
		<div class="form-group row {{ ( $errors->has('submitted') ? ($errors->has('author') ? 'has-danger' : 'has-success') : '' )  }}">
			<label for="book-author" class="col-sm-2 form-control-label"><span class="text-danger">*</span> Author</label>

			<div class="col-sm-10">
				{{ Form::text("author", $book->author, ['class'=>'form-control'.( $errors->has('submitted') ? ($errors->has('author') ? ' form-control-danger' : ' form-control-success') : '' ),'id'=>'book-author', 'type'=>'text', 'placeholder'=>'Author']) }}
				@if($errors->has('author'))
					<small class="text-danger">{{ $errors->first('author')  }}</small>
				@endif
			</div>
		</div>
		<div class="form-group row {{ ( $errors->has('submitted') ? ($errors->has('isbn') ? 'has-danger' : 'has-success') : '' )  }}">
			<label for="book-isbn" class="col-sm-2 form-control-label"><span class="text-danger">*</span> ISBN</label>

			<div class="col-sm-10">
				{{ Form::text("isbn", $book->isbn, ['class'=>'form-control'.( $errors->has('submitted') ? ($errors->has('isbn') ? ' form-control-danger' : ' form-control-success') : '' ),'id'=>'book-isbn', 'type'=>'text', 'placeholder'=>'ISBN']) }}
				@if($errors->has('isbn'))
					<small class="text-danger">{{ $errors->first('isbn')  }}</small>
				@endif
			</div>
		</div>
		<div class="form-group row {{ ( $errors->has('submitted') ? ( $errors->first('img_url') ? 'has-danger' : 'has-success') : '' )  }}">
			{{ Form::label("book-img", "Book Image", ['class'=> 'col-sm-2 form-control-label']) }}
			<div class="col-sm-10">
				{{ Form::file("img_url", ['class'=>'form-control form-control-file '.( $errors->has('submitted') ? ( $errors->first('img_url') ? 'form-control-success' : '') : '' ),'id'=>'book-image', 'type'=>'file', 'placeholder'=>'Select image']) }}
				@if($errors->has('img_url'))
					<div><small class="text-danger">{{ $errors->first('img_url')  }}</small></div>
				@endif
			</div>
		</div>
		<div class="form-group row {{ ( $errors->has('submitted') ? ( $errors->first('desc') ? 'has-success' : '') : '' )  }}">
			{{ Form::label("book-description", "Book Description", ['class'=> 'col-sm-2 form-control-label']) }}
			<div class="col-sm-10">
				{{ Form::textarea("description", $book->description, ['class'=>'form-control '.( $errors->has('submitted') ? ( $errors->first('desc') ? 'form-control-success' : '') : '' ),'id'=>'book-description', 'type'=>'text', 'placeholder'=>'Book Description']) }}
			</div>
		</div>
		<div class="pull-xs-right pull-sm-right pull-lg-right">
			{{ Form::submit('Save', ['name'=>'new_book_save', 'class'=>'btn btn-primary'] )  }}
			{{ link_to_route('books.home','Cancel',[], ['class'=>'btn btn-secondary']) }}
		</div>
	</fieldset>
	{{ Form::close() }}
@stop
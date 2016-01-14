@extends("master")

@section("content")
	<h2 class="sub-header">Books
		<small>- New Book</small>
	</h2>
	<?php var_dump(count($messages)); ?>
	{{ Form::model($book, array('route'=>'books.save_new')) }}
	<fieldset>
		<div class="form-group row">
			<label for="book-title" class="col-sm-2 form-control-label"><span class="text-danger">*</span> Book Title</label>

			<div class="col-sm-10">
				{{ Form::text("title", $book->title, ['class'=>'form-control','id'=>'book-title', 'type'=>'text', 'placeholder'=>'Book Title']) }}
			</div>
		</div>
		<div class="form-group row">
			<label for="book-author" class="col-sm-2 form-control-label"><span class="text-danger">*</span> Author</label>

			<div class="col-sm-10">
				{{ Form::text("author", $book->author, ['class'=>'form-control','id'=>'book-author', 'type'=>'text', 'placeholder'=>'Author']) }}
			</div>
		</div>
		<div class="form-group row">
			<label for="book-isbn" class="col-sm-2 form-control-label"><span class="text-danger">*</span> ISBN</label>

			<div class="col-sm-10">
				{{ Form::text("isbn", $book->isbn, ['class'=>'form-control','id'=>'book-isbn', 'type'=>'text', 'placeholder'=>'ISBN']) }}
			</div>
		</div>
		<div class="form-group row">
			{{ Form::label("book-description", "Book Description", ['class'=> 'col-sm-2 form-control-label']) }}
			<div class="col-sm-10">
				{{ Form::textarea("description", $book->description, ['class'=>'form-control','id'=>'book-description', 'type'=>'text', 'placeholder'=>'Book Description']) }}
			</div>
		</div>
		<div class="pull-xs-right pull-sm-right pull-lg-right">
			<button type="submit" name="new_book_save" class="btn btn-primary">Save</button>
			{{ link_to_route('books.home','Cancel',[], ['class'=>'btn btn-secondary']) }}
		</div>
	</fieldset>
	{{ Form::close() }}
@stop
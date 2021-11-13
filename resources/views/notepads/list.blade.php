@extends('layouts.app')

@section('content')
<!-- breadcrumb start -->
<!-- ================ -->
<div class="breadcrumb-container">
  <div class="container">
	<ol class="breadcrumb">
	  <li><i class="fa fa-home pr-10"></i><a href="/">Home</a></li>
	  <li class="active">Notepads</li>
	</ol>
  </div>
</div>
<!-- breadcrumb end -->


<!-- main-container start -->
<!-- ================ -->
<section class="main-container" style="padding-top: 20px; ">

	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading" style="height: 60px;">
						<div class="col-md-10" style="font-size: 18px; padding-left: 0px;">Notepad List <p style="font-size: 11px;">Notepads are collections of pages. A notepad can be posted in a community, or on a user profile.</p></div>
						<div class="col-md-2">
							<a href="/notepad/create" class="btn btn-primary pull-right" style="color: white; margin: 0px; padding-right: 5px; padding-left: 5px; text-align: center;">Create Notepad</a>
						</div>
					</div>
	
					<div class="panel-body">
					
						@foreach ($books as $book)
							<p><a href="#">{{ $book->name }}</a> - {{ $book->description }}</p>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
	
			
@endsection

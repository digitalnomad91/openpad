@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
				<div class="section section-custom billinfo"> 
					<!--section-title -->
					<h2><i class="fa fa-link"></i> New Link Post</h2><!--section-title end -->
					<!-- section content start-->
					<div class="pmd-card pmd-z-depth">
						<div class="pmd-card-body">	
							 {{ Form::open(array('action' => "LinkController@postNew",  'class'=>'form-horizontal new_link_form')) }}
								<div class="form-group pmd-textfield">
									<label for="inputEmail3" class="col-sm-2 control-label">URL</label>
									<div class="col-sm-10">
										<input class="form-control input-sm" id="url" placeholder="https://news.ycombinator.com/news" type="text" name="url"><span class="pmd-textfield-focused"></span>
									</div>
								</div>
								<div class="form-group pmd-textfield">
									<label for="inputEmail3" class="col-sm-2 control-label">Community</label>
									<div class="col-sm-10">
										<input class="form-control input-sm" id="sheroes" placeholder="ex. HelloWorld" type="text" name="community"><span class="pmd-textfield-focused"></span>
									</div>
								</div>
								<div class="form-group pmd-textfield">
									<label for="inputPassword3" class="col-sm-2 control-label">Title</label>
									<div class="col-sm-10">
				
										<div class="fg-line">
											<input class="form-control input-sm" id="url_title" placeholder="A really cool website title." name="title" type="text"><span class="pmd-textfield-focused"></span>
										</div>
									</div>
								</div>

								<label for="inputPassword3" class="col-sm-2 control-label">Preview</label>
								<div class="col-sm-10">
				
									<div class="form-group" style="display: none;" id="embed_wrapper">
										
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-offset-2 col-sm-10">
										<button type="submit" class="btn btn-primary pmd-checkbox-ripple-effect">Create Post <i class="fa fa-chevron-right"></i></button>
									</div>
								</div>
							 {{ Form::close() }}
						</div>
					</div> <!-- section content end -->  
				</div>
			</div>
		</div>
    </div>
</div>
@endsection

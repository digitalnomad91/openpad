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
							 {{ Form::open(array('action' => "LinkController@postNewCommunityLink",  'class'=>'form-horizontal new_link_form')) }}
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

								<div class="form-group pmd-textfield" id="embed_wrapper"  style="display: none;">
									<label for="inputPassword3" class="col-sm-2 control-label">Preview</label>
									<div class="col-sm-10">
										<div class="form-group" id="embed_container">
											
										</div>
									</div>
								</div>
								<div class="form-group pmd-textfield">
									<div class="col-sm-offset-2 col-sm-10">
										<button type="submit" class="btn btn-primary pmd-checkbox-ripple-effect" id="new_link_submit_btn">Create Post <i class="fa fa-chevron-right"></i></button>
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


<script type="text/javascript" src="/bower_components/EasyAutocomplete/dist/jquery.easy-autocomplete.min.js"></script>
    <link href="https://openpad.io/bower_components/EasyAutocomplete/dist/easy-autocomplete.css" rel="stylesheet">


    <script type="text/javascript">
    $(".new_link_form").submit(function() {
    	$("#new_link_submit_btn").html('<i class="fa fa-spinner fa-spin"></i> Loading');
    	$.ajax({
    		url: $(this).attr("action"),
    		type: "POST",
    		data: $(this).serialize(),
    		success: function(res) {
    			$("#new_link_submit_btn").html('Create Post').removeClass("disabled").removeAttr("disabled");
				if(res.errors) {
		            var n = noty({
		              text: res.errors[0],
		              type: "error",
		              theme: 'relax',
		              timeout: 3000,
		              progressBar: true,
		              dismissQueue: true,
		              killer: true,
		              animation: {
		                  open: {height: 'toggle'},
		                  close: {height: 'toggle'},
		                  easing: 'swing',
		                  speed: 500 // opening & closing animation speed
		              },
		            });
		        } else {
	    			window.location = "/link/"+res.link.id+"/comments";
	    		}
    		}
    	})
    	return false;
    })


	$("#url").focus();
	$("#url").on('change keydown paste input', function(){
			$("#new_link_submit_btn").addClass("disabled").attr("disabled", true).html('<i class="fa fa-spinner fa-spin"></i> Loading');
	      //if(ValidURL($(this).val())) {
	      		$.ajax({
	      			url: "/link/check",
	      			data: { url: $(this).val() },
	      			success: function(res) {
	      				$("#new_link_submit_btn").html('Create Post').removeClass("disabled").removeAttr("disabled");
	      				$("#url_title").val(res.title);
	      				$("#embed_container").html(res.embed_code.replace('width="480"', 'width="100%"').replace('height="270"', 'height="400"'));
	      				$("#embed_wrapper").show();

	      			}
	      		})
	      //}
	});

	 var options = {
		  url: function(phrase) {
		    return "/api/communities/search?phrase="+phrase;
		  },

		  getValue: function(element) {
		    return element.name;

		  },

		  ajaxSettings: {
		    dataType: "json",
		    method: "GET",
		    data: {
		      dataType: "json"
		    }
		  },

		  preparePostData: function(data) {
		    data.phrase = $("#example-ajax-post").val();
		    return data;
		  },

		  requestDelay: 400,

		  cssClasses: "sheroes",

		  template: {
		    type: "iconLeft",
		    fields: {
		      iconSrc: "icon"
		    }
		  },

		  list: {
		    showAnimation: {
		      type: "slide"
		    },
		    hideAnimation: {
		      type: "slide"
		    }
		  }
	};

	$("#sheroes").easyAutocomplete(options);


	function ValidURL(str) {
	  var pattern = new RegExp('^(https?:\\//\\//)?'+ // protocol
	    '((([a-z\\d]([a-z\\d-]*[a-z\d])*)\\.)+[a-z]{2,}|'+ // domain name
	    '((\\d{1,3}\\.){3}\\d{1,3}))'+ // OR ip (v4) address
	    '(\\:\d+)?(\\//[-a-z\\d%_.~+]*)*'+ // port and path
	    '(\\?[;&a-z\\d%_.~+=-]*)?'+ // query string
	    '(\\#[-a-z\\d_]*)?$','i'); // fragment locater
	  if(!pattern.test(str)) {
	    return false;
	  } else {
	    return true;
	  }
	}

</script>


@endsection

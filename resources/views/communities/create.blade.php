@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
				<div class="section section-custom billinfo"> 
					<!--section-title -->
					<h2>Create a Community</h2><!--section-title end -->
					<!-- section content start-->
					<div class="pmd-card pmd-z-depth">
						<div class="pmd-card-body">	

							@if (count($errors) > 0)
							    <div class="alert alert-danger">
							        <ul>
							            @foreach ($errors->all() as $error)
							                <li>{{ $error }}</li>
							            @endforeach
							        </ul>
							    </div>
							@endif

							 {{ Form::open(array('action' => "CommunityController@postCreate",  'class'=>'form-horizontal')) }}
								<div class="form-group pmd-textfield">
									<label for="inputEmail3" class="col-sm-2 control-label">Name</label>
									<div class="col-sm-10">
										<input class="form-control input-sm" id="pageName" placeholder="Name for your community" type="text" name="name" value="{{Input::old('name')}}"><span class="pmd-textfield-focused"></span>
									</div>
								</div>
								<div class="form-group pmd-textfield">
									<label for="inputPassword3" class="col-sm-2 control-label">Description</label>
									<div class="col-sm-10">
				
										<div class="fg-line">
											<input class="form-control input-sm" id="pageDescr" placeholder="Description for your community" name="descr" type="text" value="{{Input::old('descr')}}""><span class="pmd-textfield-focused"></span>
										</div>
									</div>
								</div>
				
								<div class="form-group">
									<div class="col-sm-offset-2 col-sm-10">
										<button type="submit" class="btn btn-primary pmd-checkbox-ripple-effect">Go</button>
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
	
	
<script type="text/javascript">
	var substringMatcher = function(strs) {
	  return function findMatches(q, cb) {
	  
		var matches, substringRegex;
	
		// an array that will be populated with substring matches
		matches = [];
	
		// regex used to determine if a string contains the substring `q`
		substrRegex = new RegExp(q, 'i');
	
		// iterate through the pool of strings and for any string that
		// contains the substring `q`, add it to the `matches` array
		$.each(strs, function(i, str) {
		  if (substrRegex.test(str)) {
			matches.push(str);
		  }
		});
	
		cb(matches);
	  };
	};
	
	var states = ['Alabama', 'Alaska', 'Arizona', 'Arkansas', 'California',
	  'Colorado', 'Connecticut', 'Delaware', 'Florida', 'Georgia', 'Hawaii',
	  'Idaho', 'Illinois', 'Indiana', 'Iowa', 'Kansas', 'Kentucky', 'Louisiana',
	  'Maine', 'Maryland', 'Massachusetts', 'Michigan', 'Minnesota',
	  'Mississippi', 'Missouri', 'Montana', 'Nebraska', 'Nevada', 'New Hampshire',
	  'New Jersey', 'New Mexico', 'New York', 'North Carolina', 'North Dakota',
	  'Ohio', 'Oklahoma', 'Oregon', 'Pennsylvania', 'Rhode Island',
	  'South Carolina', 'South Dakota', 'Tennessee', 'Texas', 'Utah', 'Vermont',
	  'Virginia', 'Washington', 'West Virginia', 'Wisconsin', 'Wyoming'
	];
	
	$('#the-basics .typeahead').typeahead({
	  hint: true,
	  highlight: true,
	  minLength: 1
	},
	{
	  name: 'states',
	  source: substringMatcher(states)
	});
</script>
		

<style>
	.twitter-typeahead{
	width:100%;
	}
		.tt-query {
	  -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
		 -moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
			  box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
	}
	
	.tt-hint {
	  color: #999
	}
	
	.tt-menu {    /* used to be tt-dropdown-menu in older versions */
	  width: 422px;
	  margin-top: 4px;
	  padding: 4px 0;
	  background-color: #fff;
	  border: 1px solid #ccc;
	  border: 1px solid rgba(0, 0, 0, 0.2);
	  -webkit-border-radius: 4px;
		 -moz-border-radius: 4px;
			  border-radius: 4px;
	  -webkit-box-shadow: 0 5px 10px rgba(0,0,0,.2);
		 -moz-box-shadow: 0 5px 10px rgba(0,0,0,.2);
			  box-shadow: 0 5px 10px rgba(0,0,0,.2);
	}
	
	.tt-suggestion {
	  padding: 3px 20px;
	  line-height: 24px;
	}
	
	.tt-suggestion.tt-cursor,.tt-suggestion:hover {
	  color: #fff;
	  background-color: #0097cf;
	
	}
	
	.tt-suggestion p {
	  margin: 0;
	}
</style>
		
@endsection

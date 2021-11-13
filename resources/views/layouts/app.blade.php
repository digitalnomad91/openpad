<!doctype html>
<html lang="">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Propeller_Admin_Dashboard">
<meta content="width=device-width, initial-scale=1, user-scalable=no" name="viewport">

	<title>@yield('title', 'OpenPad.io')</title>
	<meta name="description" content="The Project a Bootstrap-based, Responsive HTML5 Template">
	<meta name="author" content="htmlcoder.me">

	<link rel="shortcut icon" type="image/x-icon" href="/pmd/themes/images/favicon.ico">
	
	<!-- Google icon -->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	
	<!-- Bootstrap css -->
	<link rel="stylesheet" type="text/css" href="/pmd/assets/css/bootstrap.min.css">
	
	<!-- Propeller css -->
	<link rel="stylesheet" type="text/css" href="/pmd/assets/css/propeller.min.css">
	
	<!-- Propeller date time picker css-->
	<link rel="stylesheet" type="text/css" href="/pmd/components/datetimepicker/css/bootstrap-datetimepicker.css" />
	<link rel="stylesheet" type="text/css" href="/pmd/components/datetimepicker/css/pmd-datetimepicker.css" />
	
	<!-- Propeller theme css-->
	<link rel="stylesheet" type="text/css" href="/pmd/themes/css/propeller-theme.css" />
	
	  <link href="/css/font-awesome-4.5.0/css/font-awesome.min.css" rel="stylesheet">
	
	<!-- Propeller admin theme css-->
	<link rel="stylesheet" type="text/css" href="/pmd/themes/css/propeller-admin.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> 
	 <script type="text/javascript" src="https://parkitfor.me/js/noty/packaged/jquery.noty.packaged.min.js"></script>

	<script src="{{ elixir('js/vendor.js') }}"></script> 
	
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
    
        <!-- Scripts -->
        <script>
            window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
            ]); ?>
        </script>
</head>

<!-- Styles Ends -->

<body>
<!-- Header Starts -->
<!--Start Nav bar -->
<nav class="navbar navbar-inverse navbar-fixed-top pmd-navbar pmd-z-depth">

	<div class="container-fluid">
		<div class="pmd-navbar-right-icon pull-right navigation">
			<!-- Notifications -->
            <div class="dropdown notification icons pmd-dropdown">
			
				<a href="javascript:void(0)" title="Notification" class="dropdown-toggle pmd-ripple-effect"  data-toggle="dropdown" role="button" aria-expanded="true">
					<div data-badge="3" class="material-icons md-light ">notifications_none</div>
				</a>
	
				<div class="dropdown-menu dropdown-menu-right pmd-card pmd-card-default pmd-z-depth" role="menu">
					<!-- Card header -->
					<div class="pmd-card-title">
						<div class="media-body media-middle">
							<a href="notifications.html" class="pull-right">3 new notifications</a>
							<h3 class="pmd-card-title-text">Notifications</h3>
						</div>
					</div>
					
					<!-- Notifications list -->
					<ul class="list-group pmd-list-avatar pmd-card-list">
						<li class="list-group-item" style="display:none">
							<p class="notification-blank">
								<span class="dic dic-notifications-none"></span> 
								<span>You don´t have any notifications</span>
							</p>
						</li>
						<li class="list-group-item unread">
							<a href="javascript:void(0)">
								<div class="media-left">
									<span class="avatar-list-img40x40">
										<img alt="40x40" data-src="/pmd/holder.js/40x40" class="img-responsive" src="/pmd/themes/images/profile-1.png" data-holder-rendered="true">
									</span>
								</div>
								<div class="media-body">
									<span class="list-group-item-heading"><span>Prathit</span> posted a new challanegs</span>
									<span class="list-group-item-text">5 Minutes ago</span>
								</div>
							</a>
						</li>
						<li class="list-group-item">
							<a href="javascript:void(0)">
								<div class="media-left">
									<span class="avatar-list-img40x40">
										<img alt="40x40" data-src="/pmd/holder.js/40x40" class="img-responsive" src="/pmd/themes/images/profile-2.png" data-holder-rendered="true">
									</span>
								</div>
								<div class="media-body">
									<span class="list-group-item-heading"><span>Keel</span> Cloned 2 challenges.</span>
									<span class="list-group-item-text">15 Minutes ago</span>
								</div>
							</a>
						</li>
						<li class="list-group-item unread">
							<a href="javascript:void(0)">
								<div class="media-left">
									<span class="avatar-list-img40x40">
										<img alt="40x40" data-src="/pmd/holder.js/40x40" class="img-responsive" src="/pmd/themes/images/profile-3.png" data-holder-rendered="true">
									</span>
								</div>
							
								<div class="media-body">
									<span class="list-group-item-heading"><span>John</span> posted new collection.</span>
									<span class="list-group-item-text">25 Minutes ago</span>
								</div>
							</a>
						</li>
						<li class="list-group-item unread">
							<a href="javascript:void(0)">
								<div class="media-left">
									<span class="avatar-list-img40x40">
										<img alt="40x40" data-src="h/pmd/older.js/40x40" class="img-responsive" src="/pmd/themes/images/profile-4.png" data-holder-rendered="true">
									</span>
								</div>
								<div class="media-body">
									<span class="list-group-item-heading"><span>Valerii</span> Shared 5 collection.</span>
									<span class="list-group-item-text">30 Minutes ago</span>
								</div>
							</a>
						</li>
					</ul><!-- End notifications list -->
				</div>
            </div> <!-- End notifications -->
		</div>
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			  <a href="javascript:void(0);" class="btn btn-sm pmd-btn-fab pmd-btn-flat pmd-ripple-effect pull-left margin-r8 pmd-sidebar-toggle">
			  	<i class="material-icons">menu</i>
			  </a>	
			  <a href="/" class="navbar-brand">
			  	<img src="/mandala5_75.png" style="max-height: 50px;">
			  </a>
		</div>
	</div>

</nav><!--End Nav bar -->
<!-- Header Ends -->

<!-- Sidebar Starts -->
<div class="pmd-sidebar-overlay"></div>

<!-- Left sidebar -->
<aside class="pmd-sidebar sidebar-default pmd-sidebar-slide-push pmd-sidebar-left pmd-sidebar-open bg-fill-darkblue sidebar-with-icons" role="navigation">
	<ul class="nav pmd-sidebar-nav">
		
		@php
			$user = \Auth::User()
		@endphp
		@if(\Auth::User())
		<!-- User info -->
		<li class="dropdown pmd-dropdown pmd-user-info visible-xs visible-md visible-sm visible-lg">
			<a aria-expanded="false" data-toggle="dropdown" class="btn-user dropdown-toggle media" data-sidebar="true" aria-expandedhref="javascript:void(0);">
				<div class="media-left">
					<form action="/upload?_token={{ csrf_token() }}" method="post" class="avatar_dropzone">
						<div class="dz-message" data-dz-message id="avatar_dropzone_message">

							<img src="@php echo $user->Avatar() ? $user->Avatar() : '/pmd/themes/images/user-icon.png' @endphp" alt="New User" id="side_bar_my_avatar" style="width: 40px; height: 40px;">
							<div style="background-color: white; border-radius: 25px; height: 40px; width: 40px; display: none;" id="side_bar_my_avatar_loading">
								<i class="fa fa-spinner fa-spin" style='color: black; position: relative; top: 5px;'></i>
							</div>
						</div>
						<div class="dz-preview dz-image-preview" id="preview-template">
						  <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div>
						  <div class="dz-success-mark"></div>
						  <div class="dz-error-mark"></div>
						</div>
					</form>
				</div>
				<div class="media-body media-middle">{{ $user->name }}</div>
				<div class="media-right media-middle"><i class="dic-more-vert dic"></i></div>
			</a>
			<ul class="dropdown-menu">
				<li><a href="/user/1/pages">My Pages</a></li>
				<li><a href="/logout">Logout</a></li>
			</ul>
		</li><!-- End user info -->
		@else
			<!-- User info -->
			<li class="pmd-user-info visible-xs visible-md visible-sm visible-lg">
				<a class="btn-user" href="/login">
					<i class="fa fa-sign-in"></i> Sign In or Register
				</a>
			</li><!-- End user info -->
		@endif
		

		<script type="text/javascript">
		$.ajaxSetup({
		    headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    }
		});
		$(function(){
			$(".avatar_dropzone").each(function() {
			  	$(this).dropzone({
				    maxFilesize: 5,
				    dictResponseError: 'Server not Configured',
				    acceptedFiles: ".png,.jpg,.gif,.bmp,.jpeg",
				    addRemoveLinks: false, 
				    previewTemplate: document.getElementById('preview-template').innerHTML,
		            success: function(file, response){
	            		$("#side_bar_my_avatar").load( response.location, function() {
	            			$("#side_bar_my_avatar, .my_avatar").attr("src", response.location)
				      		setTimeout(function() {
				      			$("#side_bar_my_avatar_loading").hide();
				      			$("#side_bar_my_avatar").show();
				      		}, 200);
			      		});
		            },
				    init:function(){
				      var self = this;
				      // config
				      self.options.addRemoveLinks = false;
				      self.options.dictRemoveFile = "Delete";
				      //New file added
				      self.on("addedfile", function (file) {
				      	$("#side_bar_my_avatar_loading").show();
				      	$("#side_bar_my_avatar").hide();
				        console.log('new file added ', file);
				      });
				      // Send file starts
				      self.on("sending", function (file) {
				        console.log('upload started', file);
				        $('.meter').show();
				      });
				      
				      // File upload Progress
				      self.on("totaluploadprogress", function (progress) {
				        console.log("progress ", progress);
				        $('.roller').width(progress + '%');
				      });


				      self.on("queuecomplete", function (progress) {

				        $('.meter').delay(999).slideUp(999);
				      });
				      
				      // On removing file
				      self.on("removedfile", function (file) {
				        console.log(file);
				      });
			    	}
			  	});

			});
		})
		</script>
		<div id="#dropzoneerror"></div>
		
		<li> 
			<a class="pmd-ripple-effect  @if(Request::is('/')) active @endif" href="/">	
				<i class="media-left media-middle" style="padding-right: 3px;"><i class="material-icons md-dark pmd-md" style="color: #C9C8C8; font-size: 20px; margin-top: 3px;">home</i></i>
				<span class="media-body">Feed</span>
			</a> 
		</li>
		
		<li class="dropdown pmd-dropdown"> 
			<a aria-expanded="false" data-toggle="dropdown2" class="btn-user dropdown-toggle media  @if(Request::is('/c/list')) active @endif" data-sidebar="true" href="/c/list">	
				<i class="media-left media-middle" style="padding-right: 3px;"><i class="material-icons md-dark pmd-md" style="color: #C9C8C8; font-size: 20px; margin-top: 3px;">list</i></i>

				<span class="media-body">Communities</span>
				<div class="media-right media-bottom"><i class="dic-more-vert dic"></i></div>
			</a> 
			<ul class="dropdown-menu">
				<li><a href="typography.html">Typography</a></li>
				<li><a href="icons.html">Icons</a></li>
				<li><a href="shadow.html">Shadow</a></li>
				<li><a href="accordion.html">Accordion</a></li>
				<li><a href="alert.html">Alert</a></li>
				<li><a href="badge.html">Badge</a></li>
				<li><a href="button.html">Button</a></li>
				<li><a href="modal.html">Modal</a></li>
				<li><a href="dropdown.html">Dropdown</a></li>
				<li><a href="list.html">List</a></li>
				<li><a href="navbar.html">Navbar</a></li>
				<li><a href="popover.html">Popover</a></li>
				<li><a href="progressbar.html">Progressbar</a></li>
				<!--<li><a href="sidebar.html">Sidebar</a></li> -->
				<li><a href="tab.html">Tab</a></li>
				<li><a href="tooltip.html">Tooltip</a></li>
				<li><a href="card.html">Card</a></li>
				<li><a href="floating-button.html">Floating Action Button</a></li>
			</ul>
		</li>
		<li class="dropdown pmd-dropdown"> 
			<a aria-expanded="false" class="btn-user media @if(Request::is('files')) active @endif" data-sidebar="true" href="/files"><!-- data-toggle="dropdown" dropdown-toggle -->
				<i class="media-left media-middle" style="padding-right: 3px;"><i class="material-icons md-dark pmd-md" style="color: #C9C8C8; font-size: 20px; margin-top: 3px;">cloud_upload </i></i>
				<span class="media-body">Files</span>
				<div class="media-right media-bottom"><i class="dic-more-vert dic"></i></div>
			</a> 
			<ul class="dropdown-menu">
				<li><a href="custom-scroll.html">Custom Scrollbar</a></li>
				<li><a href="datetimepicker.html">Datetimepicker</a></li>
				<li><a href="range-slider.html">Range Slider</a></li>
				<li><a href="select2.html">Select2</a></li>
			</ul>
		</li>
		
		<li class="dropdown pmd-dropdown"> 
			<a aria-expanded="false" data-toggle="dropdown2" class="btn-user dropdown-toggle media  @if(Request::is('chat')) active @endif" data-sidebar="true" href="/chat">	
				<i class="media-left media-middle" style="padding-right: 3px;"><i class="material-icons md-dark pmd-md" style="color: #C9C8C8; font-size: 20px; margin-top: 3px;">chat</i></i>

				<span class="media-body">Chat</span>
				<div class="media-right media-bottom"><i class="dic-more-vert dic"></i></div>
			</a> 
			<ul class="dropdown-menu">
				<li><a href="form-element.html">Form Elements</a></li>
				<li><a href="form.html">Form Examples</a></li>
			</ul>
		</li>
		<li class="dropdown pmd-dropdown"> 
			<a aria-expanded="false" class="btn-user dropdown-toggle media @if(Request::is('settings')) active @endif" data-sidebar="true" href="/settings">
				<i class="media-left media-middle" style="padding-right: 3px;"><i class="material-icons md-dark pmd-md" style="color: #C9C8C8; font-size: 20px; margin-top: 3px;">settings</i></i>

				<span class="media-body">Settings</span>
				<div class="media-right media-bottom"><i class="dic-more-vert dic"></i></div>
			</a> 
			<ul class="dropdown-menu">
				<li><a href="table.html">Normal Table</a></li>
				<li><a href="data-table.html">Data Table</a></li>
				<li><a href="table-with-expand-collapse.html">Table with Expand/Collapse</a></li>
			</ul>
		</li>
	</ul>
</aside><!-- End Left sidebar -->
<!-- Sidebar Ends -->


	
<!--content area start-->
<div id="content" class="pmd-content inner-page">

	<!--tab start-->
	<div class="container-fluid full-width-container notifications">
		@yield("content")
	</div><!-- tab end -->
</div>
<!--end content area-->

@php
$quotes = Array(
			'Built with ❤ by <a href="https://codebuilder.io" target="_blank">CoderBuilder.io</a>.',
			'Each one teach one, each one reach one.',
			'Synchronicity is the universe\'s way of winking at you.',
			'Subtlety is the language of experience.',
			'Action expresses priorities. - Mahatma Gandhi',
			'Hack The System.',
			'Welcome to The Яevolution.',
			'Whatever\'s Clever.'
	);
$rand = rand(0, count($quotes)-1);
$footerQuote = $quotes[$rand];

@endphp


<script type="text/javascript">
$(document).ready(function() {
		var currentQuotes = new Array;
		setInterval(function() { 
			var quotes = [
				'Built with ❤ by <a href="https://codebuilder.io" target="_blank">CoderBuilder.io</a>.',
				'Each one teach one, each one reach one.',
				'Synchronicity is the universe\'s way of winking at you.',
				'Subtlety is the language of experience.',
				'Action expresses priorities. - Mahatma Gandhi',
				'Hack The System.',
				'Welcome to The Яevolution.',
				'Whatever\'s Clever.'
			];

			if(currentQuotes.length == 0) currentQuotes = quotes;
			var rand = Math.floor(Math.random() * currentQuotes.length);
			var newQuote = currentQuotes[rand];
			currentQuotes.splice(rand, 1);

			$("#footer_quote").fadeOut("slow", function() {
				$("#footer_quote").html(newQuote);
				$("#footer_quote").fadeIn("fast");
			});
		}, 
		5000);

		var currentSymbols = new Array;
		setInterval(function() { 
			var symbols = [
				'<span id="symbol"><span class="copyleft">&copy;</span></span>',
				'ॐ',
				'❤',
				'☯',
				'✞',
				'☪',
				'☮',
				'✡',
				'☘',
				'☠',
				'☣',
				'☢',
				'♔',
			];

			if(currentSymbols.length == 0) currentSymbols = symbols;
			var rand = Math.floor(Math.random() * currentSymbols.length);
			var newSymbol = currentSymbols[rand];
			currentSymbols.splice(rand, 1);

			$("#symbol").fadeOut("slow", function() {
				$("#symbol").html(newSymbol);
				$("#symbol").fadeIn("fast");
			});
		}, 
		5000);
});

function notyError(error) {
    var n = noty({
      text: error,
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
}

</script>
<style>
.copyleft {
  display:inline-block;
  transform: rotate(180deg);
  font-size: 14px;
  position: relative;
}
#symbol {
  font-size: 14px;
  position: relative;
  top: 1px;
  left: -1px;
}
.rEvolution {
    -webkit-transform: matrix(-1, 0, 0, 1, 0, 0);
    -moz-transform: matrix(-1, 0, 0, 1, 0, 0);
    -o-transform: matrix(-1, 0, 0, 1, 0, 0);
    transform: matrix(-1, 0, 0, 1, 0, 0);
}
</style>
<!-- Footer Starts -->
<!--footer start-->
<footer class="admin-footer" style="background-color: #efefef;">
 <div class="container-fluid">
 	<ul class="list-unstyled list-inline">
	 	<li>
			<span class="pmd-card-subtitle-text">OpenPad.io <span id="symbol"><span class="copyleft">&copy;</span></span> 2017.</span>
			<h3 class="pmd-card-subtitle-text" id="footer_quote">@php echo $footerQuote @endphp</h3>
        </li>
        <li class="pull-right download-now" style="display: none;">
			<a onClick="downloadPMDadmintemplate()" href="archive/pmd-admin-template-1.0.0.zip">
           		 <div>
					<svg x="0px" y="0px" width="38px" height="32px" viewBox="0 0 38 32" enable-background="new 0 0 38 32" xml:space="preserve">
					<g>
						<path fill="#A5A4A4" d="M13.906,26.652l4.045,4.043c0.001,0,0.002,0.002,0.003,0.004l1.047,1.047l1.047-1.049
							c0.001,0,0.001,0,0.001,0l4.044-4.045c0.579-0.58,0.579-1.518,0-2.098c-0.579-0.578-1.519-0.578-2.096,0l-1.514,1.514V16.22
							c0-0.818-0.664-1.482-1.483-1.482c-0.818,0-1.482,0.664-1.482,1.482v9.85l-1.515-1.516c-0.29-0.289-0.669-0.434-1.048-0.434
							c-0.38,0-0.759,0.145-1.049,0.434C13.327,25.133,13.327,26.072,13.906,26.652z"/>
						<g>
							<g>
								<path fill="#A5A4A4" d="M8.453,26.363c-0.032,0-0.065,0-0.099-0.002C3.67,26.053,0,22.137,0,17.443
									c0-4.434,3.242-8.124,7.48-8.825c0.3-4.663,4.188-8.364,8.926-8.364c2.249,0,4.393,0.844,6.032,2.346
									c4.602-1.86,9.527-0.766,12.266,2.831c1.808,2.375,2.399,5.513,1.671,8.719C37.416,15.412,38,17.008,38,18.65
									c0,3.902-3.176,7.076-7.077,7.076c-1.221,0-2.428-0.32-3.492-0.926c-0.712-0.404-0.961-1.311-0.556-2.021
									c0.404-0.713,1.312-0.963,2.021-0.557c0.619,0.352,1.319,0.539,2.027,0.539c2.267,0,4.111-1.844,4.111-4.111
									c0-1.146-0.467-2.212-1.312-3.001l-0.673-0.627l0.264-0.881c0.769-2.574,0.416-5.094-0.969-6.913
									c-2.061-2.706-5.997-3.332-9.577-1.522l-1.045,0.528L20.966,5.34c-1.139-1.347-2.802-2.12-4.56-2.12
									c-3.297,0-5.979,2.683-5.979,5.979c0,0.21,0.01,0.416,0.033,0.619l0.186,1.648l-1.784-0.004
									c-3.215,0.003-5.896,2.685-5.896,5.983c0,3.135,2.453,5.752,5.584,5.957c0.817,0.055,1.436,0.76,1.382,1.576
									C9.88,25.762,9.228,26.363,8.453,26.363z"/>
							</g>
						</g>
					</g>
					</svg>
           		 </div>
            	 <div>
              	 	<span class="pmd-card-subtitle-text">Version- 1.0.0</span>
              	 	<h3 class="pmd-card-title-text">Download Now</h3>
            	</div>
			</a>
        </li>
        <li class="pull-right for-support">
			<a href="mailto:support@openpad.io">
          		<div style="/* border: 2px solid #4D575D; border-radius: 30px; padding: 6px; */">
					<i class="fa fa-envelope-o" style="font-size: 35px; position: relative; top: -1px;"></i>
            	</div>
            	<div>
				  <span class="pmd-card-subtitle-text">Get in touch with us:</span>
				  <h3 class="pmd-card-title-text" style="position: relative; top: -3px;">support@openpad.io</h3>
				</div>
            </a>
        </li>
    </ul>
 </div>
</footer>
<!--footer end-->
<!-- Footer Ends -->

<!-- Scripts Starts -->
<script src="/pmd/assets/js/bootstrap.min.js"></script>
<script>
	$(document).ready(function() {
		var sPath=window.location.pathname;
		var sPage = sPath.substring(sPath.lastIndexOf('/') + 1);
		$(".pmd-sidebar-nav").each(function(){
			$(this).find("a[href='"+sPage+"']").parents(".dropdown").addClass("open");
			$(this).find("a[href='"+sPage+"']").parents(".dropdown").find('.dropdown-menu').css("display", "block");
			$(this).find("a[href='"+sPage+"']").parents(".dropdown").find('a.dropdown-toggle').addClass("active");
			$(this).find("a[href='"+sPage+"']").addClass("active");
		});
	});
</script>
<script type="text/javascript">
(function() {
  "use strict";
  var toggles = document.querySelectorAll(".c-hamburger");
  for (var i = toggles.length - 1; i >= 0; i--) {
    var toggle = toggles[i];
    toggleHandler(toggle);
  };
  function toggleHandler(toggle) {
    toggle.addEventListener( "click", function(e) {
      e.preventDefault();
      (this.classList.contains("is-active") === true) ? this.classList.remove("is-active") : this.classList.add("is-active");
    });
  }

})();
</script>

<script src="/pmd/assets/js/propeller.min.js"></script> 



<!--staked column chart for payment-->
<script src="/pmd/themes/js/highcharts.js"></script>
<script src="/pmd/themes/js/highcharts-more.js"></script>

<!-- Payment chart js-->
<script>
$(function paymentChart(){
    $('#payment-chart').highcharts({
        chart: {
            type: 'column'
        },
		colors: "#00719d,#2ab7ee".split(","),
        title: {
            text: 'Last 10 days comparison',
			style: {
                color: "#4d575d",
                fontSize: "14px",
            },
        },
        xAxis: {
            categories: ['9-7', '10-7', '11-7', '12-7', '13-7', '14-7', '15-7', '16-7', '17-7', '18-7']
        },
        yAxis: {
            min: 0,
			
			title: {
					text: "Amount"
			},
			stackLabels: {
					enabled: false,
					style: {
						fontWeight: 'bold',
						color: (Highcharts.theme && Highcharts.theme.textColor) || 'black'
					}
				}
			},
        legend: {
            enabled: !0,
            align: "right",
            layout: "horizontal",
            labelFormatter: function() {
                return this.name
            },
            borderColor: false,
            borderRadius: 0,
            navigation: {
                activeColor: "#274b6d",
                inactiveColor: "#CCC"
            },
            shadow: false,
            itemStyle: {
                color: "#888888",
                fontSize: "12px",
                fontWeight: "normal"
            },
            itemHoverStyle: {
                color: "#000"
            },
            itemHiddenStyle: {
                color: "#CCC"
            },
            itemCheckboxStyle: {
                position: "absolute"
            },
			symbolHeight: 10,
			symbolWidth: 10,
            symbolPadding: 5,
            verticalAlign: "bottom",
            x: 0,
            y: 0,
            title: {
                style: {
                    fontWeight: "normal"
                }
            }
        },
        tooltip: {
            headerFormat: '<b>{point.x}</b><br/>',
            pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}',
			backgroundColor: '#ffffff',
			borderColor: '#f0f0f0',
			shadow: true
        },
        plotOptions: {
            column: {
                stacking: 'normal',
                dataLabels: {
                    enabled: false,
                    color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white',
                    style: {
                        textShadow: '0 0 3px black'
                    }
                }
            }
        },
		 credits: {
            enabled: false,
        },
        series: [{
            name: 'Card',
            data: [25000, 50000, 75000, 75000, 60000, 70000, 10000, 2500, 5000, 25000]
        }, {
            name: 'Wallet',
            data: [75000, 50000, 25000, 25000, 30000, 30000, 90000, 25000, 3000, 50000]
        }]
		
    });
});
</script>

<!--staked column chart for sms details-->
<script>
$( function smsChart() { 
    $('#sms-chart').highcharts({
        chart: {
            zoomType: 'none'
        },
		colors: "#e75c5c,#9159b8".split(","),
         title: {
            text: 'Last 7 days comparison',
			style: {
                color: "#4d575d",
                fontSize: "14px",
            },
        },
        xAxis: [{
            categories: ['3-7', '4-7', '5-7', '6-7', '7-7', '8-7', '9-7']
        }],
        yAxis: [{ // Primary yAxis
            labels: {
                style: {
                    color: Highcharts.getOptions().colors[1]
                }
            },
            title: {
                text: 'User Count',
                style: {
                    color: Highcharts.getOptions().colors[1]
                }
            }
        }, { // Secondary yAxis
            title: {
                text: 'Total Days',
                style: {
                    color: Highcharts.getOptions().colors[0]
                }
            },
            labels: {
                style: {
                    color: Highcharts.getOptions().colors[0]
                }
            },
            opposite: true
        }],
		legend: {
            enabled: !0,
            align: "right",
			layout: "horizontal",
            labelFormatter: function() {
                return this.name
            },
            borderColor: false,
            borderRadius: 0,
            navigation: {
                activeColor: "#274b6d",
                inactiveColor: "#CCC"
            },
            shadow: false,
            itemStyle: {
                color: "#888888",
                fontSize: "12px",
                fontWeight: "normal"
            },
            itemHoverStyle: {
                color: "#000"
            },
            itemHiddenStyle: {
                color: "#CCC"
            },
            itemCheckboxStyle: {
                position: "absolute",
                width: "12px",
                height: "12px"
            },
			symbolHeight: 10,
			symbolWidth: 10,
            symbolPadding: 5,
            verticalAlign: "bottom",
            x: 0,
            y: 0,
            title: {
                style: {
                    fontWeight: "normal"
                }
            }
        },

        tooltip: {
            shared: true,
			backgroundColor: '#ffffff',
			borderColor: '#f0f0f0',
			shadow: true
        },
		 credits: {
            enabled: false,
        },

        series: [{
            name: 'Total Days',
            type: 'spline',
            yAxis: 1,
            data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6],
            tooltip: {
                pointFormat: '<span style="font-weight: bold; color: {series.color}">{series.name}</span>: '
            }
        }, {
            name: 'Total Days error',
            type: 'errorbar',
            yAxis: 1,
            data: [[48, 51], [68, 73], [92, 110], [128, 136], [140, 150], [171, 179], [135, 143]],
            tooltip: {
                pointFormat: '(error range: {point.low}-{point.high})<br/>'
            }
        }, {
            name: 'User Count',
            type: 'column',
            data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2],
            tooltip: {
                pointFormat: '<span style="font-weight: bold; color: {series.color}">{series.name}</span>: <b>{point.y:.1f}</b> '
            }
        }, {
            name: 'User Count error',
            type: 'errorbar',
            data: [[6, 8], [5.9, 7.6], [9.4, 10.4], [14.1, 15.9], [18.0, 20.1], [21.0, 24.0], [23.2, 25.3]],
            tooltip: {
                pointFormat: '(error range: {point.low}-{point.high})<br/>'
            }
        }]
    });
});
</script>
<!-- Scripts Ends -->
<!-- Javascript for Datepicker -->
<script type="text/javascript" language="javascript" src="/pmd/components/datetimepicker/js/moment-with-locales.js"></script>
<script type="text/javascript" language="javascript" src="/pmd/components/datetimepicker/js/bootstrap-datetimepicker.js"></script>
<script>
	// Linked date and time picker 
	// start date date and time picker 
	$('#datepicker-default').datetimepicker();
</script>

</body>
</html>
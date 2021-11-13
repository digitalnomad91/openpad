@extends('layouts.app')
@section('content')
    <!-- quill does not include dist files! We are using the hosted version instead -->
  <!--link rel="stylesheet" href="/bower_components/quill/dist/quill.snow.css" /-->
  <link href="https://cdn.quilljs.com/1.0.4/quill.snow.css" rel="stylesheet">
  <link href="//cdnjs.cloudflare.com/ajax/libs/KaTeX/0.5.1/katex.min.css" rel="stylesheet"> 
  <link href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.2.0/styles/monokai-sublime.min.css" rel="stylesheet">
  <style>
    #quill-container {
      /*border: 1px solid gray;
      box-shadow: 0px 0px 10px gray;*/
    }
  </style>
    

	<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/1.7.3/socket.io.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/KaTeX/0.5.1/katex.min.js" type="text/javascript"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.2.0/highlight.min.js" type="text/javascript"></script>
  <script src="https://cdn.quilljs.com/1.0.4/quill.js"></script>
  <!-- quill does not include dist files! We are using the hosted version instead (see above)
  <script src="/bower_components/quill/dist/quill.js"></script>
  -->
  <script src="/bower_components/yjs/y.es6"></script>


    <div class="">
 
 
        <div class="pmd-card-body">
				
			<!-- main-container start -->
			<!-- ================ -->
			<section class="main-container" style="padding-top: 0px; ">

				<div class="container2">
					<div class="row">

						<!-- main start -->
						<!-- ================ -->
						<div class="main col-md-9">
							<div id="header-1">
										<h2 class="space-top" style="padding-top: 0px; height: 40px;">
											 <div class="col-md-7 style="padding-left: 0px;">{{ $page->name }} <p style="font-size: 11px;">{{ $page->description }}</p></div>
												<div class="col-md-5" style="padding-right: 0px;">
													<a href="javascript: void(0);" id="copy_page" class="btn btn-primary pmd-btn-outline pmd-ripple-effect pull-right" style=""><i class='fa fa-files-o '></i></a>
													<a href="javascript: void(0);" id="save_page2" class="btn btn-danger pmd-btn-outline pmd-ripple-effect pull-right" style="margin-right: 5px;"><i class='fa fa-trash '></i></a>
													<a href="javascript: void(0);" id="expand_page" class="btn btn-default pmd-btn-outline pmd-ripple-effect pull-right"  style="margin-right: 5px;"><i class="fa fa-arrows-alt" aria-hidden="true"></i></a>
													<a href="javascript: void(0);" id="save_page" class="btn btn-primary pmd-btn-outline pmd-ripple-effect pull-right" style="margin-right: 5px;"><i class='fa fa-save'></i></a>

												</div>
										</h2>
										<div class="separator-2"></div>
		
										<div id="activity_div"></div>
										<div id="quill-container">
											<div id="quill"></div>
										</div>
										<input type="hidden" id="hidden_id" value="{!! $id !!}">

										<link rel="search" href="http://openpad.io:9100/opensearch.xml" title="Instant.io" type="application/opensearchdescription+xml">
										<h3 id="logHeading" style="display: none">Torrent Log</h3>
					
										<div class="log"></div>
		
										<section>
												<h4>Download File(s)</h4>
														<label for="torrentId">Download from a magnet link or info hash</label>
														<input name="torrentId" id="torrentId" placeholder="magnet:" type="hidden" required>
														<button type="submit" id="torrent_dl_submit">Download</button>
										</section>
								</div>
							</div>
							<!-- main end -->


						<!-- sidebar start -->
						<!-- ================ -->
						<aside class="col-md-3">
							<div class="sidebar">
								<nav class="affix-menu scrollspy">
									<ul class="smooth-scroll nav nav-pills nav-stacked">
									</ul>
                  <h3 class="title" style="width: 100%;"><i class="fa fa-users"></i> Connected Users</h3>
                  <div class="separator-2"></div>
                  <div id="users"></div>
                    
                  <br>
                  <h3 class="title" style="width: 100%;"><i class="fa fa-server"></i> Page Log</h3>
                  <div class="separator-2"></div>
                  <div id="log" style="max-height: 150px; overflow: scroll;"></div>
                    
                  <br>
                  <h3 class="title" style="width: 100%;"><i class="fa fa-share"></i> File Sharing</h3>
                  <div class="separator-2"></div>
                  <p>Drag-and-drop or choose file(s):</p>
                  <input type="file" name="upload" multiple>
                  <div class="speed"></div>
								</nav>
							</div>
						</aside>
						<!-- sidebar end -->

					</div>
				</div>
			</section>
			<!-- main-container end -->
           <div id="cursors_container"></div>
				</div>
		</div>
			
      

<script type="text/javascript">

var toolbarOptions = [
  ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
  ['blockquote', 'code-block'],

  [{ 'list': 'ordered'}, { 'list': 'bullet' }],
  [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
  [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent

  [{ 'header': [1, 2, 3, 4, 5, 6, false] }],

  [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
  [{ 'font': [] }],
  [{ 'align': [] }],

  ['clean']                                         // remove formatting button
];
    // create quill element
    window.quill = new Quill('#quill', {
      modules: {
        formula: false,
        syntax: false,
        toolbar: toolbarOptions
      },
      theme: 'snow'
    });
@if($page->contents && $active_count == 0)
    quill.pasteHTML(@php echo json_encode(str_replace("<br>", "<p>&nbsp</p>", $page->contents)) @endphp, 'api');
@endif





/* global Y, Quill */

// initialize a shared object. This function call returns a promise!
var socket = io("https://openpad.io:1337");
socket.emit('joinRoom', 'page-'+$("#hidden_id").val());

socket.on('connect', function () {
    socket.emit('joinRoom', 'page-'+$("#hidden_id").val());
})

window.onbeforeunload = function(e) {
  socket.disconnect();
};

Y({
  db: {
    name: 'memory'
  },
  connector: {
    name: 'webrtc',
    room: 'page-'+$("#hidden_id").val(),
    socket: socket,
    url: "https://openpad.io:8888", // the connection endpoint (see y-websockets-server)
  },
  sourceDir: '/bower_components',
  share: {
    richtext: 'Richtext' // y.share.richtext is of type Y.Richtext
  }
}).then(function (y) {
		window.yQuill = y
    // bind quill to richtext type
    y.share.richtext.bind(window.quill)
  
    
		// Extend jquery with flashing for elements
		$.fn.flash = function(duration, iterations) {
				duration = duration || 1000; // Default to 1 second
				iterations = iterations || 1; // Default to 1 iteration
				var iterationDuration = Math.floor(duration / iterations);
		
				for (var i = 0; i < iterations; i++) {
						this.fadeOut(iterationDuration).fadeIn(iterationDuration);
				}
				return this;
		}
   

    $("#log").prepend(getTime()+" - Connected to OpenPad.io P2P Editor.<br>");
    // Send ehlo event right after connect:
    socket.emit('auth', {token: "@php echo $token @endphp"});
    $("#log").prepend(getTime()+" - Initiating Authentication.<br>");
    socket.on ('authSuccess', function (data) {
      var json = JSON.parse(data);
      if(typeof json.name == "undefined") var name = "Guest";
        else var name = json.name;
        
      $("#log").prepend(getTime()+" - Authenticated as "+name+".<br>");
    });
    
    
    socket.on('message', function (data) {
				$.notify({
					// options
					message: data
				},{
					// settings
					type: 'info',
					delay: 0,
					offset : {
						y: 170,
						x: 20
					}
				});
    });
      
    socket.on('userJoined', function (data) {
        socket.emit('getUsers', 'page-'+$("#hidden_id").val(), "test");
    });

    
    
    socket.on ('userAuthenticated', function (data) {
      var json = JSON.parse(data);
      if(typeof json.name == "undefined") var name = "Guest";
        else var name = json.name;
        
      $("#log").prepend(getTime()+" - "+name+" joined the room.<br>");
      socket.emit('getUsers', 'page-'+$("#hidden_id").val(), "test");
      
    });
    
    
    socket.on ('userLeft', function (data) {
      socket.emit('getUsers', 'page-'+$("#hidden_id").val(), "test");
      $("#log").prepend(getTime()+" - User left the room.<br>");
    });
    
    /* Automatically save page every 5 seconds */
    socket.emit('getUsers', 'page-'+$("#hidden_id").val(), "test");
    setInterval(function() {
      socket.emit('getUsers', 'page-'+$("#hidden_id").val(), "test");
    }, 5000);
    
    socket.on ('updateUserList', function (data) {
      var json = JSON.parse(data);
      var user_html = "";
      for (i = 0; i<json.length; i++) {
        user_html = user_html + json[i].customId+" - ("+json[i].room+")<br>";
      }
      $("#users").html(user_html);
    });
    
    

    socket.on('shareTorrentWithusers', function (data) {
      $("#log").prepend(getTime()+" - "+data.whoShared+" just shared file(s): <a href='javascript: downloadTorrent(\""+data.magnet_uri+"\")'>Download Now ("+data.name+")</a> <br>");
    });
  
    
    /* Automatically save page every 5 seconds */
    setInterval(function() {
      if ($(".ql-editor").html() != "<p><br></p>") {
        SavePage();
      }
    }, 5000)

    $("#save_page").click(function() {
      SavePage();
    });
		
		$("#copy_page").click(function() {
			//ar r = confirm("Are you sure you want to copy the contents into a new page?");
			var retVal = prompt("Enter a name for your page : ", "{{$page->name}} (Copy)");
			if (typeof(retVal) != "undefined") {
				$.ajax({
					data: {name: retVal },
					url: "/page/{{$page->id}}/copy",
					type: "post",
					success: function(res) {
						if (res.success) window.location = "/page/"+res.data.page_id+"/view";
							else alert(res.error);
					}
				})
			}
		})
    
    function SavePage() {
      $("#save_page").html("<i class='fa fa-spinner fa-spin'></i>").addClass("disabled").attr("disabled", "true").blur();
      
			var str = $(".ql-editor").html();
			
			html = str.replace("  ", "&nbsp;");
			html = html.replace(/<br ?\/?>/g, " ")
			
      socket.emit('savePage', {token: "@php echo $token @endphp", pageData: html, pageID: "@php echo $page->id @endphp"});

    }
    
    socket.on('savePageDone', function (data) {
      $("#save_page").html("<i class='fa fa-save'></i>").removeClass("disabled").removeAttr("disabled");
    });



@if($page->contents && $active_count == 0)
    quill.pasteHTML(@php echo json_encode($page->contents) @endphp, 'api');
@endif

@if($page->views < 1)
    quill.setContents([
      { insert: 'Hello World!', attributes: { bold: true } },
      { insert: '\n' },
        { insert: '\n' },
      { insert: '\n' },
      { insert: '\n' },
      { insert: '\n' },
      { insert: '\n' },
      { insert: '\n' },
      { insert: '\n' },
      { insert: '\n' },
      { insert: '\n' },
      { insert: '\n' },
      { insert: '\n' },
      { insert: '\n' },
      { insert: '\n' }
    ]);
@endif
    
    /*
window.quill.on('selection-change', function(range, oldRange, source) {
  if (range) {
    if (range.index != 0) {
     offset = range.index;
   
      console.log('User cursor is on', range.index);
      
$('span').each(function() {
if($(this).attr('style')) { 
    if($(this).attr('style').indexOf('background-color: red;') > -1) {
        $(this).remove();
    }
}
});

quill.clipboard.dangerouslyPasteHTML(range.index-1, '<span style="background-color: red;">&nbsp;</span>', 'silent');
var height = $("#quill").height();
var width = $("#qwill").find(".ql-editor").width();
$("#activity_div").html('<div id="quill-container2" style="position: absolute; border: 0px; outline: none; right: 1530px; width: 100%; top: 176px;  width: 1600px; height: '+height+'px; overflow: hide; "><div style="font-size: 13px;" class="quill_copy">'+$("#quill").html()+"</div></div>");
$(".ql-hidden").hide();
$(".quill_copy p").each(function() {

  if($(this).find('span[style="background-color: red;"]').length) {
    if($(this).find('.ql-size-huge').length) {
      var position = "position: relative; top: 20px;";
    } else var position = "position: relative; top: 20px;";
    
    $(this).html('<div style="width: 100%; text-align: right; '+position+'"><span style="background-color: red; color: blue;">&nbsp;</span></div>');
    return;
    
  }  else {
    $(this).css("position", "relative");
    $(this).css("right", "800px");
  }
});
$("#quill").find('span[style="background-color: red;"]').remove();
      
      
    } else {
      var text = window.quill.getText(range.index, range.length);
      console.log('User has highlighted', text);
    }
  } else {
    console.log('Cursor not in the editor');
  }
});



  
const Parchment = Quill.import('parchment')
quill.on('editor-change', (range) => {
  const selection = document.getSelection()
  const node = selection.getRangeAt(0).startContainer
  const blot = Parchment.find(node)
  let block = blot
  // find ancestor block blot
  while (block.statics.blotName !== 'block' && block.parent)
    block = block.parent
  const root = block.parent // assume parent of block is root
  let cur
  const next = root.children.iterator()
  let index = 0
  while (cur = next()) {
    index++
    if (cur === block) break
  }
  console.log(index)
})

*/



})

function downloadTorrent(magnet_uri) {
  $("#torrentId").val(magnet_uri);
  $("#torrent_dl_submit").click();
}

function getTime() {
    var date = new Date();


    var hour = date.getHours();
    var min = date.getMinutes();
    var sec = date.getSeconds();

    hour = (hour < 10 ? "0" : "") + hour;
    min = (min < 10 ? "0" : "") + min;
    sec = (sec < 10 ? "0" : "") + sec;

    var str =  hour + ":" + min + ":" + sec;

    /*alert(str);*/

    return str;
}
</script>
      <script src="https://openpad.io:9101/bundle.js"></script>

  
  
  <div class="user-initials"></div>

  
  
  <style>
#content {
	background-color: white;
	
}
	
  .inputor {
    overflow: auto;
    height: 160px;
    width: 90%;
    border-radius: 4px;
    padding: 5px 8px;
    outline: 0 none;
    margin: 10px 0;
    background: white;
  }
  .inputor:focus {
  }
  
  
  .offset-box {
    position: absolute;
    top: 0;
    left: 0;
    z-index: 999;
  }
  .offset-box > .position-box {
    position: absolute;
    bottom: 0;
    right: 0;
    z-index: 10000;
  }
  .indicators > .offset-indicator {
    position: absolute;
    z-index: 999;
    padding: 0 3px;
  } 
  .indicators > .position-indicator {
    border: 1px solid rgb(6, 150, 247);
    position: absolute;
    bottom: -20px;
    padding: 0 3px;
    border-radius: 3px;
  }
  .ql-editor{ min-height: 400px; }
  div.editor {
    resize: auto;
    overflow: auto;
    padding: 10px;
    line-height: 1.5;
    border: 1px solid blue;
}
span.cursor {
    display: block;
    width: 1px;
    height: 18px;
    background: red;
    position: absolute;
    top: 0;
    left: 0;
}
.ins_str {
    color: red;
    background-color:red;
    width: 5px;
    height: 10px;
}


  .ql-container {
    font-family: Raleway,sans-serif;
    
  }
  
  </style>




  
@endsection

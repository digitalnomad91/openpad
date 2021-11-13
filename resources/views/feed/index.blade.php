@extends('layouts.app')

@section('title', $pageTitle)

@section('content')

<div class="row">
    <div class="col-md-9">
        <div class="row pagesHeader">
            <div class="col-md-10">
                <ul class="nav nav-tabs" role="tablist" style="width: 100%;">
                    <li role="presentation" class="active"><a href="#default" aria-controls="default" role="tab" data-toggle="tab"><i class="fa fa-fire"></i> Hot</a></li>
                    <li role="presentation"><a href="#fixed" aria-controls="fixed" role="tab" data-toggle="tab"><i class="fa fa-certificate"></i> New</a></li>
                    <li role="presentation"><a href="#scrollable" aria-controls="scrollable" role="tab" data-toggle="tab"><i class="fa fa-thumbs-up"></i> Popular</a></li>
                    <li role="presentation"><a href="#scrollable2" aria-controls="scrollable" role="tab" data-toggle="tab"><i class="fa fa-thumbs-down"></i> Controversial</a></li>
                </ul>
            </div>
            <div class="col-md-2">
                <span class="dropdown pmd-dropdown clearfix pull-right">
                	<button style="padding-left: 5px; padding-right: 5px; min-width: 45px;" class="btn btn-success pmd-ripple-effect btn-primary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-expanded="true"><i class="fa fa-plus"></i></button>
                	<ul aria-labelledby="dropdownMenu2" role="menu" class="dropdown-menu dropdown-menu-right">
                		<li class="dropdown-header" role="presentation">Choose a post type:</li>
                		<li role="presentation"><a href="/link/new" tabindex="-1" role="menuitem"><i class="fa fa-link"></i> &nbsp;Link Post</a></li>
                		<li role="presentation"><a href="javascript:void(0);" tabindex="-1" role="menuitem"><i class="fa fa-comment"></i> &nbsp;Text Post</a></li>
                		<li role="presentation"><a href="javascript:void(0);" tabindex="-1" role="menuitem"><i class="fa fa-file"></i> &nbsp;File Post</a></li>
                		<li role="presentation"><a href="javascript:void(0);" tabindex="-1" role="menuitem"><i class="fa fa-file-text"></i> &nbsp;Live Doc</a></li>
                	</ul>
                </span>
            </div>
        </div>
        @foreach ($items as $item)
            @php
                $date = \Carbon\Carbon::createFromTimeStamp(strtotime($item->created_at));
            @endphp
        	<div class="pmd-table-card pmd-card pmd-z-depth feed_post">
        		<div class="feed_arrows" data-id="@php $item->id @endphp" data-type="" style="float: left; text-align: center;">
        			<i class="fa fa-arrow-up" style="font-size: 18px; cursor: pointer; color: #<?=$item->up_color?>;" data-id="{{$item->communityLink->id}}"></i>
        			<div style="margin-left:height: 24px; margin-top: 0px; text-align: center; width: 41px; color: #BBBBBB; font-size: 18px; font-weight: 800; margin-top: 2px;" class="votes_div">
        				<div class="net_votes" style="position: relative; top: -6px;"><?=$item->communityLink->net_votes?></div>
        				<div class="loading_votes" style="display: none; position: relative; padding-left: 4px; top: -6px;"><i class="fa fa-spinner fa-spin"></i></div>
        			</div>
        			<i class="fa fa-arrow-down" style="font-size: 18px; cursor: pointer; position: relative; top: -9px; color: #<?=$item->down_color?>;" data-id="{{$item->communityLink->id}}"></i>
        		</div>

        		<div class="feed_post_img"><img src="{{$item->image}}"></div>
        		<div class="feed_post_title">
        			<a href="{{ $item->url }}"><img src="{{$item->icon}}"> {{ $item->title }}</a>  <span style="color: grey; font-size: 12px;">({{$item->hostname}})</span>
        			<div class="feed_post_title_secondary">
                        <div style="position: relative; top:2px; color: grey; font-size: 11px;"">
                            by <a href="/link/{{$item->communityLink->id}}/comments" style="color: grey; font-size: 11px;"">{{$item->user->name}}</a>
                            &middot;
                            {{$date->format('F jS, Y')  }} ({{ $date->diffForHumans() }})
                        </div>

                        <a href="/p/{{$item->communityLink->community->name}}" style="color: grey; font-size: 11px;"">/p/{{$item->communityLink->community->name}}</a>
        				&middot;
        				<a href="/link/{{$item->communityLink->id}}/comments" style="color: grey; font-size: 11px;"">0 Comments</a>
        			</div>
        		</div>
        	</div>
        @endforeach
    </div>

    <div class="col-md-3">
        <div class="row pagesHeader">
            <div class="col-md-6">
                <h1 style="margin-top: 0px;">@php echo $feedTitle @endphp</h1>
            </div>
        </div>


        <div class="pmd-table-card pmd-card pmd-z-depth feed_post" style="text-align: center;">
            <div style="padding-top: 23px;">Welcome to The Portal.</div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {         
		(function() {
			var link = document.createElement('link');
			link.type = 'image/x-icon';
			link.rel = 'shortcut icon';
			link.href = 'http://upload.wikimedia.org/wikipedia/commons/thumb/4/44/Cannabis_leaf_2.svg/35px-Cannabis_leaf_2.svg.png';
			document.getElementsByTagName('head')[0].appendChild(link);
		}());       
    })
</script>

<script type="text/javascript">
$(document).ready(function() {
    var loading_arr = new Array();
    
    $(".fa-arrow-up, .fa-arrow-down").each(function() {
		$(this).unbind("click");
        $(this).click(function() {

            @if(!$user) 
                var n = noty({
                  text: "You must login to vote!",
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
                return false;
            @endif

            
            var id = $(this).parent("div").data("id");
            if(typeof(loading_arr[id]) != "undefined") {
                return;
            }

            var loadingDict = loading_arr.count+1;
            loading_arr[id] = 1;

            var type = $(this).parent("div").data("type");
            var direction = $(this).hasClass("fa-arrow-down") ? "down" : "up";
            var opposite_direction = $(this).hasClass("fa-arrow-down") ? "up" : "down";
            var opposite_direction_div = $(this).parent("div").find(".fa-arrow-"+opposite_direction);
                            
            var active_hex = (direction=="up"?'#FF6600':'#3399FF').toLowerCase();
            var grey_hex = '#BBBBBB'.toLowerCase();
            
            var previously_active_direction = $(this).getHex("color") == active_hex ? direction : opposite_direction;
            
            var count_div = $(this).parent("div").find(".net_votes");

            if($(this).getHex('color') != active_hex) {
                opposite_direction_div.css('color', grey_hex);
                $(this).css('color', active_hex);
            } else { //if hex isnt changing then assume double click and undo previous action
               $(this).css('color', grey_hex);
            }
            
            $(this).parent("div").find(".loading_votes").show();
            $(this).parent("div").find(".net_votes").hide();
            var that = this;
            
            $.ajax({
              url: "/vote/link/"+$(this).data("id")+"/?ajax=1&type="+type+"&vote="+(direction == "up"?"1":"0")+"&id="+id,
              success: function(data) {
                    delete loading_arr[id];
                    if(!data) {
                        alert("Error...");
                        return;
                    }
                    if(data.error) {
                        $(that).parent("div").find(".loading_votes").hide();
                        $(that).parent("div").find(".net_votes").show();
                        $(that).css('color', grey_hex);
                        
                        alert(json.error);
                        return;
                    }
                    
                    count_div.html(data.count);
                    $(that).parent("div").find(".loading_votes").hide();
                    $(that).parent("div").find(".net_votes").show();
                   
              }
            });
            
            
        });
    })
});
    
$.fn.getHex = function(type) {
    var rgb = $(this).css(type);
    if (!rgb) {
        return '#FFFFFF'; //default color
    }
    var hex_rgb = rgb.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/); 
    function hex(x) {return ("0" + parseInt(x).toString(16)).slice(-2);}
    if (hex_rgb) {
        return "#" + hex(hex_rgb[1]) + hex(hex_rgb[2]) + hex(hex_rgb[3]);
    } else {
        return rgb; //ie8 returns background-color in hex format then it will make                 compatible, you can improve it checking if format is in hexadecimal
    }
}







/* Animated Sorting */

function animateSort(parent, child, sortAttribute) {
  var promises = [];
  var positions = [];
  var originals = $(parent).find(child);
  var sorted = originals.toArray().sort(function(a, b) {
    return $(a).attr(sortAttribute) > $(b).attr(sortAttribute);
  });

  originals.each(function() {
    //store original positions
    positions.push($(this).position());
  }).each(function(originalIndex) {
    //change items to absolute position
    var $this = $(this);
    var newIndex = sorted.indexOf(this);
    sorted[newIndex] = $this.clone(); //copy the original item before messing with its positioning
    $this.css("position", "absolute").css("top", positions[originalIndex].top + "px").css("left", positions[originalIndex].left + "px");

    //animate to the new position
    var promise = $this.animate({
      top: positions[newIndex].top + "px",
      left: positions[newIndex].left + "px"
    }, 1000);
    promises.push(promise);
  });

  //instead of leaving the items out-of-order and positioned, replace them in sorted order
  $.when.apply($, promises).done(function() {
    originals.each(function(index) {
      $(this).replaceWith(sorted[index]);
    });
  });
}

$(function() {
  $("input").click(function() {
    animateSort("#listing", "div", "data-value");
  });
});

</script>

<div style="display: none;">
<input type="button" value="Sort" />
<div id="listing">
  <div data-value="5" class="item">item 5</div>
  <div data-value="3" class="item">item 3</div>
  <div data-value="2" class="item">item 2</div>
  <div data-value="1" class="item">item 1</div>
  <div data-value="4" class="item">item 4</div>
</div>
</div>

	
<style>
	.feed_post {
		height: 85px;
		margin-bottom: 15px;
		padding: 5px;
	}
	.feed_post_img { float: left; }
	.feed_post_img img { height: 75px; width: 100px; }
	.feed_post_title { float: left; margin-left: 10px; }
	.feed_post_secondary { float: left; }


	.pagesHeader {
		margin-top: 15px;
	}
	.createPage {
		margin-top: 10px;
	}
	
</style>		
@endsection

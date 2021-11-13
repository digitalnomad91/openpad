@extends('layouts.app')

@section('content')


<div class="row">
    <div class="col-md-9">
        <div class="row pagesHeader">
            <div class="col-md-10">
                <h2>Active Transfers</h2>
            </div>
            <div class="col-md-2">
                <span class="dropdown pmd-dropdown clearfix pull-right">
                	<button style="padding-left: 5px; padding-right: 5px; min-width: 45px;" class="btn btn-success pmd-ripple-effect btn-primary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-expanded="true"><i class="fa fa-plus"></i></button>
                	<ul aria-labelledby="dropdownMenu2" role="menu" class="dropdown-menu dropdown-menu-right">
                		<li class="dropdown-header" role="presentation">Choose a file type:</li>
                		<li role="presentation"><a data-target="#form-dialog" data-toggle="modal" href="#"><i class="fa fa-link"></i> &nbsp;Link Post</a></li>
                		<li role="presentation"><a href="javascript:void(0);" tabindex="-1" role="menuitem"><i class="fa fa-comment"></i> &nbsp;Text Post</a></li>
                		<li role="presentation"><a href="javascript:void(0);" tabindex="-1" role="menuitem"><i class="fa fa-file"></i> &nbsp;File Post</a></li>
                		<li role="presentation"><a href="javascript:void(0);" tabindex="-1" role="menuitem"><i class="fa fa-file-text"></i> &nbsp;Live Doc</a></li>
                	</ul>
                </span>
            </div>
        </div>
       
		<div class="pmd-table-card pmd-card pmd-z-depth">
			<table class="table pmd-table table-hover">
				<thead>
					<tr>
						<th style="width: 60%;">Name</th>
						<th style="width: 10%; text-align: center;">Progress</th>
						<th style="width: 10%; text-align: center;">Size</th>
						<th style="width: 10%; text-align: center;">Download</th>
						<th style="width: 10%; text-align: center;">Upload</th>
					</tr>
				</thead>
			</table>
			<table class="table pmd-table table-hover">
				<tbody id="webtorrents_wrapper">

				</tbody>
				</table>
		</div>
    </div>

    <div class="col-md-3">
        <div class="row pagesHeader">
            <div class="col-md-6">
                <h1 style="margin-top: 0px;">test</h1>
            </div>
        </div>
        <div class="pmd-table-card pmd-card pmd-z-depth feed_post" style="text-align: center;">
            <div style="padding-top: 23px;">Welcome to The Portal.</div>
        </div>

	    <main>
	    <div style="display: none;">
	        <h1 id="logHeading" style="display: none;">Log</h1>
	        <div class="speed"></div>
	        <div class="log"></div>
	    </div>
	        <section>
	            <h1>Share</h1>
	                <input type="file" name="upload" multiple>
	            </p>
	        </section>
	        <section>
	            <h1>Download</h1>
	            <form>
	                <label for="torrentId">Download from a magnet link or info hash</label>
	                <input name="torrentId" placeholder="magnet:" required>
	                <button type="submit" id="torrent_dl_submit">Download</button>
	            </form>
	        </section>
	    </main>
    </div>
</div>


<table id="webtorrent_row_template" style="display: none;">
	<tr>
		<td style="width: 60%;">
			<a href="javascript:;" class="webtorrent_name_link">test</a> <br>


			<a href="javascript: void(0);" style="color: grey; font-size: 11px;"">
				<i class="fa fa-user"></i> <span class="webtorrent_peersnum">0</span>
			</a>
			&middot;
			<a href="javascript:;" style="color: grey; font-size: 11px;"" class="webtorrent_files_total"></a>
			&middot;
	        <a href="javascript: void(0);" class="webtorrent_magnet_link" style="color: grey; font-size: 11px;""><i class="fa fa-magnet"></i></a>
			&middot;
			<a href="javascript: void(0);" class="webtorrent_share_link" style="color: grey; font-size: 11px;""><i class="fa fa-share-alt"></i></a>
			&middot;
			<a href="javascript: void(0);" target="_blank" class="webtorrent_download_link" style="color: grey; font-size: 11px;"">
				<i class="fa fa-globe"></i>
			</a>
		</td>
		<td style="width: 10%; text-align: center;"><div class="webtorrent_progress_num"></div></td>
		<td style="width: 10%; text-align: center;">
			<a href="javascript:;" class="webtorrent_upload_size"></div></a>
		</td>
		<td style="width: 10%; text-align: center;"><div class="webtorrent_download_speed"></div></td>
		<td style="width: 10%; text-align: center;"><div class="webtorrent_upload_speed"></div></td>


		
	</tr>
</table>


<div tabindex="-1" class="modal fade" id="listing-dialog" style="display: none;" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bordered">
				<button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
				<h2 class="pmd-card-title-text"><i class="fa fa-save"></i> File List</h2>
			</div>
			<div class="pmd-modal-list">
				<ul class="list-group pmd-list-icon" id="modal_filelist">

				</ul>
			</div>
			<div class="pmd-modal-action pmd-modal-bordered text-right">
				<button data-dismiss="modal"  class="btn pmd-ripple-effect btn-primary pmd-btn-flat" type="button">Cancel</button>
			</div>
		</div>
	</div>
</div>



<div tabindex="-1" class="modal fade" id="form-dialog" style="display: none;" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bordered">
				<button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
				<h2 class="pmd-card-title-text">Form Modal</h2>
			</div>
			<div class="modal-body">
				<form class="form-horizontal">
					<div class="form-group pmd-textfield pmd-textfield-floating-label">
						<label for="first-name">Name</label>
						<input type="text" class="mat-input form-control" id="name" value="">
						<span class="help-text">Input is required!</span> </div>
					<div class="form-group pmd-textfield pmd-textfield-floating-label">
						<label for="first-name">Email Address</label>
						<input type="text" class="mat-input form-control" id="email" value="">
					</div>
					<div class="form-group pmd-textfield pmd-textfield-floating-label">
						<label for="first-name">Mobile No.</label>
						<input type="text" class="mat-input form-control" id="mobil" value="">
					</div>
					<div class="form-group pmd-textfield pmd-textfield-floating-label">
						<label class="control-label">Message</label>
						<textarea required class="form-control"></textarea>
					</div>
					<label class="checkbox-inline pmd-checkbox pmd-checkbox-ripple-effect">
						<input type="checkbox" value="">
						<span class="pmd-checkbox"> Accept Terms and conditions</span> </label>
				</form>
			</div>
			<div class="pmd-modal-action">
				<button data-dismiss="modal"  class="btn pmd-ripple-effect btn-primary" type="button">Save changes</button>
				<button data-dismiss="modal"  class="btn pmd-ripple-effect btn-default" type="button">Discard</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
var webtorrentUX = {
	torrents: Array,
	/* Insert a new webtorrent into the DOM */
	insertWebtorrent: function(torrent, path, util) {
		this.torrent = torrent;

		var html = $($("#webtorrent_row_template").html());

		console.log(html[0].outerHTML);
		html.find('.webtorrent_name_link').html(path.basename(torrent.name, path.extname(torrent.name)));
		html.find(".webtorrent_magnet_link").attr("href", torrent.magnetURI);
		html.find(".webtorrent_share_link").attr("href", "#"+torrent.infoHash);
		html.find(".webtorrent_download_link").attr("href", torrent.torrentFileBlobURL);
		html.find(".webtorrent_files_total").html("<i class='fa fa fa-file'></i> "+torrent.files.length+" file"+(torrent.files.length == 1? "" : "s"));


		html.find("td").addClass("torrent_"+torrent.infoHash);

		var progressBarHtml = '<div class=" progress-rounded progress progress-striped pmd-progress active" style="margin-bottom: 0px; position: relative; top: 1px;"><div class="progress-bar progress-bar-success torrent_progress_bar" style="width: 0%;"></div></div>';
		$("#webtorrents_wrapper").prepend("<tr><td class='torrent_"+torrent.infoHash+"'colspan=5 style='border-top: 0px; padding: 0px;'>"+progressBarHtml+"</td></tr>");

		$("#webtorrents_wrapper").prepend("<tr style='display: none;'>"+html[0].outerHTML+"</tr>").slideDown('fast');
		html.slideDown();

	},

	/* Filelist Modal Popup */
	fileList: function(infoHash) {
		var torrent = this.torrents[infoHash];
		$("#modal_filelist").html("");

		torrent.files.forEach(function (file) {
			// append download link
			file.getBlobURL(function (err, url) {
			  if (err) alert(err);

			  var fileLinkHtml = '<li class="list-group-item"><div class="media-body"><i class="fa fa-file"></i> <a href="'+url+'" target="_blank">'+file.name+'</a></div></li>';
			  $("#modal_filelist").append(fileLinkHtml);


				// append file
				//file.appendTo($("#modal_filelist")[0], {
				//  maxBlobLength: 2 * 1000 * 1000 * 1000 // 2 GB
				//}, function (err, elem) {
				//  if (err) return util.error(err)
				//})

			})
		})

		$('#listing-dialog').modal('show');

	}
}

$(document).on('click', '.webtorrent_files_total', function(e) {
	var infoHash = $(this).parent("td").attr("class").replace("torrent_", "");
	webtorrentUX.fileList(infoHash);
	return false;
});
$(document).on('click', '.webtorrent_name_link', function(e) {
	var infoHash = $(this).parent("td").attr("class").replace("torrent_", "");
	webtorrentUX.fileList(infoHash);
	return false;
});


</script>
<script src="https://openpad.io:9100/bundle.js"></script>


<style>
	.table > tbody > tr > td {
		padding-top: 3px;
	}
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
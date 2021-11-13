@extends('layouts.app')

@section('title', $pageTitle)

@section('content')

@php
$date = \Carbon\Carbon::createFromTimeStamp(strtotime($link->created_at));
@endphp

<div id="link_wrapper">
<div class="col-md-4 col-sm-6 masonry-brick" style="">
		<h3 class="text-muted">Link Post</h3>
		<div class="pmd-card pmd-card-default pmd-z-depth">
			<div class="pmd-card-title">
			  <div class="media-left">
				<a class="avatar-list-img" href="javascript:void(0);">
					<img src="{{ $user->Avatar() }}" height="50" width="50">
				</a>
			  </div>
			  <div class="media-body media-middle">
				<h3 class="pmd-card-title-text">{{$user->name}}</h3>
				<span class="pmd-card-subtitle-text">{{$date->format('F jS, Y')  }} ({{ $date->diffForHumans() }})</span>
			  </div>
			</div>
			<div class="pmd-card-media">
				@if(!$link->embed) 
					<img src="{{ $link->image }}" class="img-responsive" height="666" width="1184">
				@else
					@php  
						$new_value = '';
						$html = preg_replace('/height="[0-9]+"/', $new_value, $link->embed);
						$new_value = 'style="width: 100%; max-height: 500px; min-height: 300px;"';
						$html = preg_replace('/width="[0-9]+"/', $new_value, $html);
						echo $html;
					@endphp
				@endif
			</div>
			<div class="pmd-card-title">
				<h2 class="pmd-card-title-text" style="font-size: 18px;">{{ $link->title }}</h2>
				<span class="pmd-card-subtitle-text">{{ $link->provider_url }}</span>	
			</div>	
			<div class="pmd-card-body">
				{{ $link->description }}
			</div>
			<div class="pmd-card-actions">
				<button class="btn btn-sm pmd-btn-fab pmd-btn-flat pmd-ripple-effect btn-primary" type="button"><i class="material-icons pmd-sm">share</i></button>
				<button class="btn btn-sm pmd-btn-fab pmd-btn-flat pmd-ripple-effect btn-primary" type="button"><i class="material-icons pmd-sm">thumb_up</i></button>
				<button class="btn btn-sm pmd-btn-fab pmd-btn-flat pmd-ripple-effect btn-primary" type="button"><i class="material-icons pmd-sm">drafts</i></button>
			</div>
		</div>
	</div>
</div>

<style>
#link_wrapper { margin-top: 15px; }
</style>
	
@endsection

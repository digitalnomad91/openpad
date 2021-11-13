@extends('layouts.app')

@section('content')
<div class="row pagesHeader">
<div class="col-md-6">
<h1>My Pages</h1>
</div>
<div class="col-md-6">
<a href="/page/create" class="createPage btn btn-primary pull-right"><i class="fa fa-plus"></i> Create Page</a>
</div>
</div>
	
<div class="pmd-table-card pmd-card pmd-z-depth">
	<table class="table pmd-table table-hover">
		<thead>
			<tr>
				<th>Name</th>
				<th>Description</th>
				<th>Created At</th>
				<th>Updated At</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($pages as $page)
				<tr style="cursor: pointer;" onClick="window.location='/page/{{ $page->id }}/view'">
					<td data-title="Name"><a href="/page/{{ $page->id }}/view">{{ $page->name }}</a></td>
					<td>{{ $page->description }}</td>
					<td>{{ $page->created_at }}</td>
					<td>{{ $page->created_at }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>
	
<style>
	.pagesHeader {
		margin-top: 15px;
	}
	.createPage {
		margin-top: 10px;
	}
	
</style>		
@endsection

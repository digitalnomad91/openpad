@extends('layouts.app')

@section('content')
<div class="row pagesHeader">
<div class="col-md-6">
<h1>Communities</h1>
</div>
<div class="col-md-6">
<a href="/c/create" class="createPage btn btn-primary pull-right"><i class="fa fa-plus"></i> Create Community</a>
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
						@foreach ($communities as $community)

				<tr style="cursor: pointer;" onClick="window.location='/c/{{ $community->name }}'">
					<td data-title="Name"><a href="/c/{{ $community->name }}">{{ $community->name }}</a></td>
					<td>{{ $community->descr }}</td>
					<td>{{ $community->created_at }}</td>
					<td>{{ $community->created_at }}</td>
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

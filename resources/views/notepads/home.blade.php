@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Create A Notepad</div>

				<div class="panel-body">
					This form creates a notepad. <br>
                
                        {{ Form::open(array('action' => "NotepadController@create")) }}
                        {{ Form::label('name', 'Name:') }}
                        {{ Form::text('name') }}
                        <br>
                        {{ Form::label('description', 'Description:') }} <br>
                        {{ Form::textarea('description') }}
                        <br>
                        {{ Form::submit('Go!') }}
                        {{ Form::close() }}
				</div>
			</div>
		</div>
    </div>
      
</div>
@endsection

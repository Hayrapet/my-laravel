@extends('layouts.app')
@section('content')
<div style='width:50%'>
<h3>create albums</h3>
{!!Form::open(['action'=>'AlbumsController@store','method'=>'POST','enctype'=>'multipart/form-data'])!!}
{{Form::text('name','',['placeholder' => 'Album Name'])}}
{{Form::textarea('description','',['placeholder' => 'Album pescription'])}}
{{Form::file('cover_image')}}
{{Form::submit('submit')}}
{!!Form::close()!!}

</div>
@endsection
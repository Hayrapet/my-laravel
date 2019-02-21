@extends('layoutss.app')
@section('content')
<div class="container">
<div style='width:50%'>
<h3>Upload Photos</h3>
{!!Form::open(['action'=>'PhotosController@store','method'=>'POST','enctype'=>'multipart/form-data'])!!}
{{Form::text('title','',['placeholder' => 'Photo Title'])}}
{{Form::textarea('description','',['placeholder' => 'Photo pescription'])}}
{{Form::hidden('album_id',$album_id)}}
{{Form::file('photo')}}
{{Form::submit('submit')}}
{!!Form::close()!!}

</div>
</div>
@endsection
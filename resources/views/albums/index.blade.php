@extends('layouts.app')
@section('content')
<h3>Albums</h3>
@foreach($albums as $album)
{{$album->name}}
@endforeach
@endsection
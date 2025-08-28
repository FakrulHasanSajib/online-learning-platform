@extends('layouts.app')
@section('content')
<h2>🎓 Student Dashboard</h2>
<div class="row">
@foreach($courses as $c)
 <div class="col-md-4"><div class="card p-3 mb-2">
   <h5>{{$c->title}}</h5>
   <p>Teacher: {{$c->teacher->name}}</p>
   <a href="{{route('courses.show',$c)}}" class="btn btn-outline-success">Start</a>
 </div></div>
@endforeach
</div>
@endsection
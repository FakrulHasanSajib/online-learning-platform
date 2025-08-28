@extends('layouts.app')
@section('content')
<h2>📚 Courses</h2>
<div class="row">
@foreach($courses as $c)
 <div class="col-md-4 mb-3">
   <div class="card p-3">
     <h5>{{$c->title}}</h5>
     <p class="text-muted">By {{$c->teacher->name}}</p>
     <a href="{{route('courses.show',$c)}}" class="btn btn-sm btn-primary">View</a>
   </div>
 </div>
@endforeach
</div>
@endsection
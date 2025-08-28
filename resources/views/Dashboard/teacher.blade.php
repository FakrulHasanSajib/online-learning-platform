@extends('layouts.app')
@section('content')
<h2>👨‍🏫 Teacher Dashboard</h2>
<a href="{{route('courses.create')}}" class="btn btn-primary mb-3">+ Create Course</a>
<div class="row">
@foreach($courses as $c)
 <div class="col-md-4"><div class="card p-3 mb-2">
   <h5>{{$c->title}}</h5>
   <p>{{Str::limit($c->description,80)}}</p>
   <small>{{$c->students_count}} student(s)</small>
 </div></div>
@endforeach
</div>
@endsection
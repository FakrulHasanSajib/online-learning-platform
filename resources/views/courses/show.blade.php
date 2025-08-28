@extends('layouts.app')
@section('content')
<div class="card p-4">
 <h3>{{$course->title}}</h3>
 <p>{{$course->description}}</p>
 <p><b>Teacher:</b> {{$course->teacher->name}}</p>

 @auth
   @if(auth()->user()->role==='student')
     <form method="post" action="{{route('courses.enroll',$course)}}">@csrf
       <button class="btn btn-success">Enroll</button>
     </form>
   @endif
 @else
   <a href="/login" class="btn btn-primary">Login to Enroll</a>
 @endauth
</div>
@endsection
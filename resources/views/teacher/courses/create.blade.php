@extends('layouts.app')
@section('content')
<h2>Create Course</h2>
<form method="post" action="{{route('courses.store')}}" class="card p-3">@csrf
<input name="title" placeholder="Title" class="form-control mb-2">
<textarea name="description" placeholder="Description" class="form-control mb-2"></textarea>
<button class="btn btn-primary">Save</button>
</form>
@endsection
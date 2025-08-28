<!doctype html><html><head>
<meta charset="utf-8"><title>LMS</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>body{background:#f8f9fa}</style>
</head><body>
<nav class="navbar navbar-expand navbar-light bg-white border-bottom shadow-sm">
 <div class="container">
   <a class="navbar-brand" href="/">LMS</a>
   <div class="ms-auto">
     <a href="/courses" class="btn btn-link">Courses</a>
     @auth
       <a href="/dashboard" class="btn btn-link">Dashboard</a>
       <form method="POST" action="/logout" class="d-inline">@csrf<button class="btn btn-link">Logout</button></form>
     @else
       <a href="/login" class="btn btn-link">Login</a>
       <a href="/register" class="btn btn-link">Register</a>
     @endauth
   </div>
 </div>
</nav>
<div class="container py-4">@yield('content')</div>
</body></html>
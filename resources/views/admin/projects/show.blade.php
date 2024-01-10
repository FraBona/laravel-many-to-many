@extends('layouts.app');

@section('content')
  <section class="container">
    <h1>{{$project->title}}</h1>
    <h3>{{$project->content}}</h3>
    @if ($project->type)
      <h5>{{$project->type->name}}</h5>
    @endif
    
    <ul class="d-flex gap-2 ps-0">
      @foreach ($project->technologies as $technology)
        <li class="badge rounded-pill text-bg-primary">{{$technology->name}}</li>  
      @endforeach   
    </ul>

    <a href="{{route('admin.projects.index')}}" class="btn btn-primary">Home</a>
  </section>

@endsection
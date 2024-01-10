@extends('layouts.app');

@section('content')
<head>
  
</head>
  <section class="container">
    <h1>Projects</h1>
    <a href="{{route('admin.projects.create')}}" class="btn btn-primary">Crea Nuovo progetto</a>
  </section>
  <section class="container">
    <table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Title</th>
          <th>Slug</th>
          <th>Type</th>
          <th>edit</th>
          <th>delete</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($projects as $project)
          <tr>
            <td>{{$project->id}}</td>
            <td>
              <a href="{{route('admin.projects.show', $project)}}">{{$project->title}}</a>
            </td>
            <td>{{$project->slug}}</td>
            <td>
              {{isset($project->type) ? $project->type->name : '-'}}
            </td>
            <td>
              <a href="{{route('admin.projects.edit', $project)}}" class="btn btn-info">edit</a>
            </td>
            <td>
              <form action="{{route('admin.projects.destroy', $project)}}" method="post">
                @csrf
                @method('DELETE')

                <input type="submit" value="delete" onclick="return confirm('are you sure you want delete this item')" class="btn btn-danger">
              </form>
            </td>
          </tr>
        @empty
          <tr>
            <td>Nessun progetto</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </section>
@endsection
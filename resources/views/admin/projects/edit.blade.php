@extends('layouts.app');

@section('content')
  <section class="container">
    <form action="{{route('admin.projects.update', $project)}}" method="POST">
      @csrf
      @method('PUT')
      <label for="title">Title</label>
      <input type="text" name="title" id="title" value="{{$project->title}}" class="form-control">
      <label for="content">Content</label>
      <textarea name="content" id="content" cols="30" rows="10" class="form-control">{{$project->title}}</textarea>
      <label for="type_id">Tipologia del contenuto</label>
      <select name="type_id" id="type_id" class="form-control">
        <option>Seleziona categoria</option>
        @foreach ($types as $type)
          <option @selected( old('type_id', optional($project->type)->id) == $type->id) value="{{$type->id}}">{{$type->name}}</option>
        @endforeach
      </select>

      <input type="submit" class="btn btn-primary">
    </form>

  </section>
@endsection
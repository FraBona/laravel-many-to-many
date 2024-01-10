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

      <div class="form-group">
        <p>Seleziona le tecnologie:</p>
        <div class="d-flex flex-wrap">
          @foreach ($technologies as $technology)
            <div class="form-check">
              <input type="checkbox" class="form-check-input" value="{{$technology->id}}" name="technology[]" id="technology-{{$technology->id}}" @checked(in_array($technology->id, old('techonologies',$project->technologies->pluck('id')->all())))>
              <label for="technology-{{$technology->id}}" class="form-check-label">{{$technology->name}}</label>
            </div>
          @endforeach
        </div>
      </div>

      <input type="submit" class="btn btn-primary">
    </form>

  </section>
@endsection
@extends('layouts.app');

@section('content')
  <section class="container">
    <form action="{{route('admin.projects.store')}}" method="POST">
      @csrf
      <div class="form-group">
        <label for="title">Inserisci il titolo</label>
        <input type="text" id="title" name="title" class="form-control">
        <label for="content">Inserisci il contenuto</label>
        <textarea name="content" id="content" cols="30" rows="10" class="form-control"></textarea>
        <label for="type_id">Tipologia del contenuto</label>
        <select name="type_id" id="type_id" class="form-control">
          <option>Seleziona categoria</option>
          @foreach ($types as $type)
            <option @selected( old('type_id') === $type->id) value="{{$type->id}}">{{$type->name}}</option>
          @endforeach
        </select>
        <div class="form-group">
          <p>Seleziona le tecnologie:</p>
          <div class="d-flex flex-wrap">
            @foreach ($technologies as $technology)
              <div class="form-check">
                <input type="checkbox" class="form-check-input" value="{{$technology->id}}" name="technology[]" id="technology-{{$technology->id}}" @checked(in_array($technology->id, old('techonologies',[])))>
                <label for="technology-{{$technology->id}}" class="form-check-label">{{$technology->name}}</label>
              </div>
            @endforeach
          </div>
        </div>
        <input type="submit" class="btn btn-primary" value="Crea" class="form-control">
      </div>
    </form>
  </section>
@endsection
@extends('flexcms::admin.layout')

@section('content')

  <p class="title">
    Edytuj autora

  </p>

  <form action="{{route('author-update')}}" method="POST" class="form" id="mainform">
    @method('PUT')
    @csrf

    <div class="field">
      <label class="label">Imię i nazwisko</label>
      <div class="control">
        <input class="input" type="text" name="name" value="{{ old('name', $author->name) }}">
      </div>
    </div>

    <div class="field">
      <label class="label">Bio</label>
      <div class="control">
        <textarea name="bio" class="textarea">{{ old('bio', $author->bio) }}</textarea>
      </div>
    </div>

    @if($author->img)
    <div class="field">
      <div class="control">
        <input class="input" type="text" name="img" value="{{ old('img', $author->img) }}">
      </div>
    </div>
    @endif

    <div class="control has-text-right">
      <input type="submit" class="button" value="Zapisz">
    </div>
  </form>

  <hr>

  @if($author->img)
    <img src="{{$author->img}}" alt="" width="70">
  @endif

  <form name="photoform" action="{{route('authorphoto')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="file is-small">
      <label class="file-label">
        <input class="file-input" type="file" name="photo" id="photobutton" onchange="submit()">
        <span class="file-cta">
          <span class="file-label">
            Wgraj zdjęcie
          </span>
        </span>
      </label>
    </div>
  </form>



@endsection

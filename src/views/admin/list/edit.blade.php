@extends('flexcms::admin.layout')

@section('content')

  <p class="title">Edytuj listę</p>

  <div class="columns">

    <div class="column">
      <form action="{{route('list.update',['list'=>$list->id])}}" method="POST" class="form">
        @method('PUT')
        @csrf
        @include('flexcms::admin.list._form')
      </form>
    </div>

    <div class="column is-one-fifth">

      @if($list->img)
        <img src="{{$list->img}}" alt="" width="70">
      @endif

      <form name="photoform" action="{{route('listphoto')}}" method="post" enctype="multipart/form-data">
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
        <input type="hidden" name="list_id" value="{{$list->id}}">
      </form>
    </div>
  </div>

@endsection

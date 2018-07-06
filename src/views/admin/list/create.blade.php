@extends('flexcms::admin.layout')

@section('content')

  <p class="title">Dodaj listę</p>

  <form action="{{route('list.index')}}" method="POST" class="form">
    @csrf
    @include('flexcms::admin.list._form')
  </form>

@endsection

@extends('flexcms::admin.layout')

@section('content')

  <p class="title">Dodaj stronę</p>

  <form action="{{route('page.index')}}" method="POST" class="form">
    @csrf
    @include('flexcms::admin.page._form')
  </form>

@endsection

@section('script')

@endsection

@section('css')

@endsection

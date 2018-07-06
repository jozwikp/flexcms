@extends('flexcms::admin.layout')

@section('content')

<div class="columns is-multiline">

  <div class="column">
    <p class="title">Lista użytkowników</p>

    <table class="table is-fullwidth is-striped">
      <thead>
        <tr>
          <th>Użytkownik</th>
          <th>Akcja</th>
        </tr>
      </thead>
      <tbody>
        @foreach($users as $user)
        <tr>
          <td>
            <strong>{{$user->name}}</strong> ({{$user->email}})
          </td>
          <td>
            <a href="/flexcms/user/{{$user->id}}/admin/add" class="button">Mianuj adminem</a>
            <a href="/flexcms/user/{{$user->id}}/author/add" class="button">Mianuj autorem</a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <div class="column">
    <p class="title">Lista autorów</p>

    <table class="table is-fullwidth is-striped">
      <thead>
        <tr>
          <th>Użytkownik</th>
          <th>Liczba stron</th>
          <th>Akcja</th>
        </tr>
      </thead>
      <tbody>
        @foreach($authors as $author)
        <tr>
          <td>
            <strong>{{$author->user->name}} ({{$author->user->email}})</strong> jako
            {{$author->name}}
          </td>
          <td>
            {{$author->pages_count}}
          </td>
          <td>
            @if(!$author->pages_count)
            <a href="/flexcms/user/{{$author->user_id}}/author/del" class="button">Zabierz autora</a>
            @endif
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <div class="column">
    <p class="title">Lista adminów</p>

    <table class="table is-fullwidth is-striped">
      <thead>
        <tr>
          <th>Użytkownik</th>
          <th>Akcja</th>
        </tr>
      </thead>
      <tbody>
        @foreach($admins as $admin)
        <tr>
          <td>
            <strong>{{$admin->user->name}} ({{$admin->user->email}})</strong>
          </td>
          <td>
            <a href="/flexcms/user/{{$admin->user_id}}/admin/del" class="button">Zabierz admina</a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

@endsection

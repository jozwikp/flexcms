@extends('flexcms::admin.layout')

@section('content')

<div class="columns">
  <div class="column is-one-third">

    <p class="title is-3">Struktura strony</p>

    <a href="{{route('list.create')}}" class="button">Dodaj kategorię</a>

    <table class="table is-fullwidth is-striped">
      <thead>
        <tr>
          <th>Lista główna</th>
          <th>Lista podrzędna</th>
        </tr>
      </thead>
      <tbody>
        @foreach($lists as $list)
          <tr>
            <td>
              <a href="{{route('list.edit', ['list' => $list->id])}}">{{$list->name}}</a>
              <br/>
              /{{$list->path}}
              <br/>
              @if(!$list->siblings->count() && !$list->pages->count())
              <form class="" action="{{route('list.destroy', ['list' => $list->id])}}" method="post">
                @csrf
                @method('DELETE')
                <input type="submit" value="Usuń" class="button is-small">
              </form>
              @endif
            </td>
            <td>
              <ul>
              @foreach($list->siblings as $sibling)
                <li>
                  <a href="{{route('list.edit', ['list' => $sibling->id])}}">{{$sibling->name}}</a>
                  <br/>
                  /{{$sibling->path}}
                  <br/>
                  @if(!$sibling->pages->count())
                  <form class="" action="{{route('list.destroy', ['list' => $sibling->id])}}" method="post">
                    @csrf
                    @method('DELETE')
                    <input type="submit" value="Usuń" class="button is-small">
                  </form>
                  @endif
                </li>
              @endforeach
              </ul>

            </td>
          </tr>
        @endforeach
      </tbody>
    </table>

  </div>


  <div class="column">

    <p class="title is-3">Strony</p>
    <a href="{{route('page.create')}}" class="button">Dodaj stronę</a>

    <table class="table is-fullwidth is-striped">
      <thead>
        <tr>
          <th>Tytuł</th>
          <th>Lista</th>
          <th>Autor</th>
          <th>Opublikowany</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach($pages as $page)
          <tr>
            <td>
              <a href="{{route('page.edit', ['page' => $page->id])}}">
                {{$page->title}}
              </a>
              <br/>
              /{{$page->path}}
            </td>
            <td>
              @if($page->list)
              {{$page->list->name or '-'}}
              <br/>
              /{{$page->list->path}}
              @else
              brak dowiązania
              @endif
            </td>
            <td>{{$page->author->name or '-'}}</td>
            <td>{{($page->is_published) ? 'Tak' : 'Nie' }}</td>
            <td>
              <a href="{{route('page.show',['page' => $page->id])}}" target="_blank" class="button">
                Podgląd
              </a>
            </td>
          </tr>
        @endforeach
      </tbody>
      <tfoot>
        <tr>
          <td colspan="5">{{ $pages->links() }}</td>
        </tr>
      </tfoot>
    </table>
  </div>


</div>

@endsection

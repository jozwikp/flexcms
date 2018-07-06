@foreach($lists as $list)
  @if($list->siblings->count())
  <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="/{{ $list->path }}" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{ $list->name }}
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            @foreach($list->siblings as $sibling)
              <a class="dropdown-item" href="/{{ $sibling->path }}">{{$sibling->name}}</a>
            @endforeach
          </div>
        </li>
  @else
    <li class="nav-item">
        <a class="nav-link" href="/{{ $list->path }}">{{ $list->name }}</a>
    </li>
  @endif
@endforeach

@foreach($lists as $list)
  <li class="nav-item">
      <a class="nav-link" href="/{{ $list->path }}">{{ $list->name }}</a>
  </li>
@endforeach

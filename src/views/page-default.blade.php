@extends(config('flexcms.website_layout_view'))

@section('title', $page->meta_title)
@section('meta-description', $page->meta_description)

@section('content')

<div class="container">

  @if($page->img)
  <img class="coverphoto-background" src="{{$page->img}}">
  @endif

  <div class="row">

    <div class="col-9">

      <article>
        <div class="content">

        <div class="post-intro">
          <h1 class="title is-1 is-spaced">{{$page->title}}</h1>
          <h6 class="is-6">
            {{$page->author->name}} napisał ten post
            <span class="tag is-light">{{$page->created_at->toDateString()}}</span>
            @if($page->list)
              w kategorii <a href="/{{$page->list->path}}">{{$page->list->name}}</a>
            @endif
            .
            Długość czytania do <span class="tag is-light">{{$page->readTime}} minut</span>
          </h6>
        </div>

        <div class="has-text-justified post-content">
           {!!$page->content!!}
        </div>

      </div>
      </article>
    </div>
    <div class="col-3">
      <aside class="menu">
        <h3 class="menu-label">
          Kategorie:
        </h3>
        <ul class="menu-list">

          @if($page->list->parent_id)
            @foreach($page->list->parent->siblings as $category)
              <li>
                <a href="/{{$category->path}}" @if($page->list->id==$category->id) class="is-active" @endif>
                  {{$category->name}}
                </a>
              </li>
            @endforeach
          @else

            @foreach($page->list->siblings as $category)
              <li>
                <a href="/{{$category->path}}">
                  {{$category->name}}
                </a>
              </li>
            @endforeach

          @endif

        </ul>
      </aside>
    </div>

  </div>
</div>

@endsection

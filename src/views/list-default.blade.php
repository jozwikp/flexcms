@extends(config('flexcms.website_layout_view'))

@section('title', $list->meta_title)
@section('meta-description', $list->meta_description)

@section('content')

<div class="container">


  @if($list->img)
  <div class="coverphoto-background" style="background-image: url('{{$list->img}}')"></div>
  @endif

  <div class="row">
    <div class="col-9">

    <h1 class="title">
        {{$list->name}}
    </h1>

    @foreach($pages as $page)
      <div class="card">

        @if($page->img)
            <img class="card-img-top" src="{{$page->img}}">
        @endif

        <div class="card-body">
          <div class="content">
            <h1 class="title is-4 is-spaced">
              <a href="/{{$page->path}}">
                {{$page->title}}
              </a>
            </h1>
            <p class="">
              @if($page->list)
                <a href="/{{$page->list->path}}">{{$page->list->name}}</a>
              @endif
              Długość czytania do <span class="tag is-light">{{$page->readTime}} minut</span>
            </p>
            <p class="subtitle has-text-justified">
              @if(!empty($page->description)) {{$page->description}}
              @else
                {{str_limit(strip_tags($page->content),200)}}
              @endif
            </p>
          </div>
        </div>
      </div>
    @endforeach

    @if(config('flexcms.paginate')<$allPagesCount)
      @if($requested['pagination']>0)
          <a href="/{{$list->path}}/{{($requested['pagination']-1) or ''}}" class="button is-pulled-left">Poprzednia strona</a>
      @endif
      @if($allPagesCount>config('flexcms.paginate')*($requested['pagination']+1))
          <a href="/{{$list->path}}/{{$requested['pagination']+1}}" class="button is-pulled-right">Następna strona</a>
      @endif

    @endif

    </div>
    <div class="col-3">

      <div class="fix-on-desktop">


        <aside class="menu">
          <h3 class="menu-label">
            Kategorie:
          </h3>
          <ul class="menu-list">

            @if($list->parent_id)
              @foreach($list->parent->siblings as $category)
                <li>
                  <a href="/{{$category->path}}" @if($list->id==$category->id) class="is-active" @endif>
                    {{$category->name}}
                  </a>
                </li>
              @endforeach
            @else

              @foreach($list->siblings as $category)
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


</div>


@endsection

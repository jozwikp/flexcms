<input type="hidden" name="is_published" value="0">

    @if($page->path)
    <div class="field">
      <label class="label">Treść</label>
      <div class="control">
        <textarea name="content" rows="25" class="textarea" id="contentfield">{{ old('content', $page->content) }}</textarea>
      </div>
    </div>
    @endif



<div class="columns">
  <div class="column">


    <div class="field">
      <label class="label">Nazwa</label>
      <div class="control">
        <input class="input" type="text" name="title" value="{{ old('title', $page->title) }}">
      </div>
    </div>

    <div class="field">
      <label class="label">Opis</label>
      <div class="control">
        <textarea name="description" class="textarea">{{ old('description', $page->description) }}</textarea>
      </div>
    </div>

    @if($page->path)
    <label class="label">Path</label>
    <div class="field has-addons">
      <p class="control">
          <a class="button is-static">
            {{env('APP_URL')}}/
          </a>
        </p>
      <div class="control">
        <input class="input" name="path" type="text" value="{{ old('path', $page->path) }}">
      </div>
    </div>
    @endif

    <div class="field">
      <label class="label">Widocznośc publiczna</label>
      <input type="checkbox" name="is_published" value="1" @if($page->is_published) checked @endif>
        Opublikowany
    </div>

    <div class="field">
      <label class="label">Lista</label>
      <div class="control">
        <div class="select">
        <select class="" name="list_id">
          <option value=""> bez przydziału </option>
          @foreach($lists as $list)
            <option value="{{$list->id}}"
              @if(old('list_id')==$list->id) selected @endif
              @if($page->list_id==$list->id) selected @endif
            >/{{$list->path}} - {{$list->name}}</option>
          @endforeach
        </select>
        </div>
      </div>
    </div>

    <div class="field">
      <label class="label">Autor</label>
      <div class="control">
        <div class="select">
        <select class="" name="author_id">
          @foreach($authors as $author)
            <option value="{{$author->user_id}}"
              @if(old('author_id')==$author->user_id) selected @endif
              @if($page->author_id==$author->user_id) selected @endif
            >{{$author->name}}</option>
          @endforeach
        </select>
        </div>
      </div>
    </div>
  </div>
  <div class="column">

    <div class="field">
      <label class="label">Tagi</label>
      <div class="control">
        <input class="input" name="tags" type="text" value="{{ old('tags', $page->tags) }}">
      </div>
    </div>

    <div class="field">
      <label class="label">Title meta</label>
      <div class="control">
        <input class="input" type="text" name="meta_title" value="{{ old('meta_title', $page->meta_title) }}">
      </div>
    </div>

    <div class="field">
      <label class="label">Opis meta</label>
      <div class="control">
        <textarea name="meta_description" class="textarea">{{ old('meta_description', $page->meta_description) }}</textarea>
      </div>
    </div>

    <div class="field">
      <label class="label">Kolejność</label>
      <div class="control">
        <input class="input" name="order" type="number" value="{{ old('order', $page->order ?? '1') }}">
      </div>
    </div>

    <div class="field">
      <label class="label">Template name</label>
      <div class="control">
        <input class="input" name="template" type="text" value="{{ old('template', $page->template ?? 'default') }}">
      </div>
    </div>

    @if($page->path)
    <div class="field">
      <label class="label">
        Cover photo
        @if($page->img)
          <img src="{{$page->img}}" alt="" width="70">
        @endif
      </label>
      <div class="control">
        <input class="input" type="text" name="img" value="{{ old('img', $page->img) }}">
      </div>
    </div>
    @endif

  </div>
</div>

<hr>
<div class="control has-text-right">
  <input type="submit" class="button" value="Zapisz">
</div>

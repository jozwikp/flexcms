<div class="columns">

  <div class="column">

    <div class="field">
      <label class="label">Typ listy</label>
      <div class="control">
        <div class="select">
        <select class="" name="parent_id">
            <option value=""> - lista glówna -</option>
          @foreach($lists as $listlist)
            <option value="{{$listlist->id}}"
              @if(old('parent_id')==$listlist->id) selected @endif
              @if($list->parent_id==$listlist->id) selected @endif
            >Lista pod listą: {{$listlist->name}}</option>
          @endforeach
        </select>
        </div>
      </div>
    </div>

    <div class="field">
      <label class="label">Nazwa</label>
      <div class="control">
        <input class="input" type="text" name="name" value="{{ old('name', $list->name) }}">
      </div>
    </div>

    @if($list->path)
    <label class="label">Path</label>
    <div class="field has-addons">
      <p class="control">
          <a class="button is-static">
            {{env('APP_URL')}}/
          </a>
      </p>
      <div class="control">
        <input class="input" name="path" type="text" value="{{ old('path', $list->path) }}">
      </div>
    </div>
    @endif

    <div class="field">
      <label class="label">Opis</label>
      <div class="control">
        <textarea name="description" class="textarea">{{ old('description', $list->description) }}</textarea>
      </div>
    </div>
  </div>



  <div class="column">
    <div class="field">
      <label class="label">Title meta</label>
      <div class="control">
        <input class="input" type="text" name="meta_title" value="{{ old('meta_title', $list->meta_title) }}">
      </div>
    </div>

    <div class="field">
      <label class="label">Opis meta</label>
      <div class="control">
        <textarea name="meta_description" class="textarea">{{ old('meta_description', $list->meta_description) }}</textarea>
      </div>
    </div>

    <div class="field">
      <label class="label">Kolejność</label>
      <div class="control">
        <input class="input" name="order" type="number" value="{{ old('order', $list->order ?? '1') }}">
      </div>
    </div>

    <div class="field">
      <label class="label">Template name</label>
      <div class="control">
        <input class="input" name="template" type="text" value="{{ old('template', $list->template ?? 'default') }}">
      </div>
    </div>

    @if($list->img)
    <div class="field">
      <label class="label">Cover photo</label>
      <div class="control">
        <input class="input" type="text" name="img" value="{{ old('img', $list->img) }}">
      </div>
    </div>
    @endif

  </div>
</div>

<hr>
<div class="control has-text-right">
  <input type="submit" class="button" value="Zapisz">
</div>

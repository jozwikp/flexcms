@extends('flexcms::admin.layout')

@section('content')

  <p class="title">
    Edytuj stronę
    <a href="{{route('page.show',['page' => $page->id])}}" target="_blank" class="button">
      Podgląd
    </a>
  </p>

  <div class="columns">

    <div class="column">

      <form action="{{route('page.update',['page'=>$page->id])}}" method="POST" class="form" id="mainform">
        @method('PUT')
        @csrf
        @include('flexcms::admin.page._form')
      </form>

    </div>

    <div class="column is-one-fifth">
      <form name="photoform" action="{{route('pagephoto')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="file is-small">
          <label class="file-label">
            <input class="file-input" type="file" name="photo" id="photobutton">
            <span class="file-cta">
              <span class="file-label">
                Wgraj zdjęcie
              </span>
            </span>
          </label>
        </div>
        <input type="hidden" name="page_id" value="{{$page->id}}">
      </form>
      <div id="photolist">
        @include('flexcms::admin.photo._photolist')
      </div>
    </div>

  </div>

@endsection

@section('script')

<script>


function typeInTextarea(el, newText) {
  var start = el.prop("selectionStart")
  var end = el.prop("selectionEnd")
  var text = el.val()
  var before = text.substring(0, start)
  var after  = text.substring(end, text.length)
  el.val(before + newText + after)
  el[0].selectionStart = el[0].selectionEnd = start + newText.length
  el.focus()
}

$(document).ready(function() {
  /*
  $('#contentfield').summernote({
    height: 500
  });
  */

  $('.inputphoto').click(function() {
    typeInTextarea($("#contentfield"), '<img src="'+this.dataset.photo+'">\n');
  });
  $('.coverphoto').click(function() {
      $('input[name="img"]').val(this.dataset.photo);
      $("#mainform").submit();
  });

  $("#photobutton").change(function(e) {

    var form = document.forms.namedItem("photoform");

    let formData = new FormData(form);


    //axios.post('{{route('pagephoto')}}',formData).then(function (response) {
    //$.post('{{route('pagephoto')}}',formData).done(function( response ) {
      jQuery.ajax({
          url: '{{route('pagephoto')}}',
          data: formData,
          cache: false,
          contentType: false,
          processData: false,
          method: 'POST',
          type: 'POST', // For jQuery < 1.9
          success: function(data){
            $("#photolist").html(data);

            $('.inputphoto').click(function() {
              typeInTextarea($("#contentfield"), '<img src="'+this.dataset.photo+'">\n');
            });
            $('.coverphoto').click(function() {
                $('input[name="img"]').val(this.dataset.photo);
                $("#mainform").submit();
            });
          }
      });
      /*
      $("#photolist").html(response.data);

      $('.inputphoto').click(function() {
        typeInTextarea($("#contentfield"), '<img src="'+this.dataset.photo+'">\n');
      });
      $('.coverphoto').click(function() {
          $('input[name="img"]').val(this.dataset.photo);
          $("#mainform").submit();
      });
      */
      /*
      $('.clickablephoto').click(function() {
          $('#contentfield').summernote('insertImage', this.src);
      });
      */
      //  document.getElementById('photolist').innerHTML = response.data;
  //  });

  });

});
</script>
@endsection


@section('css')

<style>
  #photolist img {
    margin: 5px;
  }
</style>
@endsection

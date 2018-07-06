
<table class="table is-fullwidth is-striped">

  @foreach($photos as $photo)
  <tr>
    <td>
      <img src="{{Storage::url($photo)}}" alt="" width="70">
    </td>
    <td>
      <button class="inputphoto button is-small" data-photo="{{Storage::url($photo)}}">Wstaw</button><br/>
      <button class="coverphoto button is-small" data-photo="{{Storage::url($photo)}}">Cover</button><br/>
    </td>
  </tr>
  @endforeach

</table>

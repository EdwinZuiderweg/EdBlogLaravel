<center>
@foreach ($articles as $article)
  <?php $artDatum = date("d-m-Y", strtotime($article->Datum));?>
  <div id = "divartikel" class = "clsartikel">
  <font size="6"><b>{{ $article-> Artikelnaam}} </b></font>
    {{$artDatum}}
  <br>

  <i><font size = "2">Categorie:
  @foreach ($artcategories as $category)
    @if ($article-> Artnr == $category -> artikelnr)
      {{$category-> catnaam}}
    @endif
  @endforeach
  </font></i><hr>
  <br>{{ $article-> Artikelinhoud }} <br>
  @if ($article-> allowreacties == true)
    <?php $reactionnr = 0 ?>
    @foreach ($reactions as $reaction)
      @if ($article-> Artnr == $reaction-> artikelid)
          @if ($reactionnr == 0)
            <div id = "divcomment"  class = "clscomment">
            <br><hr><b>Reacties:</b>
            <br><ul>
             <?php $reactionnr++ ?>
          @endif
          <li><i>Anoniem: {{$reaction-> reactie}} </i></li>
      @endif
    @endforeach
    @if ($reactionnr > 0)
      </ul></div>
    @endif
    <div id = "divcommentform" class = "clscommentform">
    <hr>
    <form method = "POST" action= "edblog/posts">
      {{csrf_field()}}
      <textarea name = "reaction" id = "artcommentform{{$article-> Artnr}}"></textarea>
      <input type = "hidden" name= "artnr" value = {{$article-> Artnr}}>
      <input type = "submit" name = "Plaatscomment" value = "geef reactie">
    </form>
    </div>
  @endif
  </div>
@endforeach
</center>

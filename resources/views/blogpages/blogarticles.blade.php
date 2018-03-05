  @foreach ($articles as $article)
    <div id = "divartikel" class = "clsartikel">

    <h1>{{ $article-> Artikelnaam}} </h1>
    @foreach ($artcategories as $category)
      @if ($article-> Artnr == $category -> artikelnr)
        <font size = "2"><i>{{$category-> catnaam}} </i></font> ,
      @endif
    @endforeach
    <br>{{ $article-> Artikelinhoud }} <br>
    </div>
   @endforeach

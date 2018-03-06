<!DOCTYPE = html>
<html>
<head>
  <title>GorillaBlog</title>

  <meta charset = utf-8>

  <meta name = "description"  content="gorillablog">
  <meta name = "keywords" content = "gorillablog">
  <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
  <link rel = "stylesheet" href= "<?php echo asset('css/blog.css') ?>" type="text/css">
  <script>
     function Selectartcat(catnr) {
       if (catnr!= "") {
           ActCatnr = catnr;
           var xhttp = new XMLHttpRequest();
           var myURL = "edblog/filter/" + catnr;
           xhttp.open("GET", myURL, false);
           xhttp.send();
           //alert(xhttp.responseText);
           var artikeldiv = document.getElementById("divartikelen");
           //alert(xhttp.responseText);
           artikeldiv.innerHTML = xhttp.responseText;
       }

     }
  </script>

</head>
<body>
  <div id = "divheader" class = "clsheader">
    <center><h1>GorillaBlog</h1></center>
  </div>
  <div id = "divcontainer">
    <div id = "divmenu">
      <ul>
      @foreach ($categories as $category)
         <li onClick = "Selectartcat({{$category-> catid}})">{{$category-> catnaam}}</li>
      @endforeach
    </ul>
    </div>
    <div id = "divartikelen">
      <center>
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
        @if ($article-> allowreacties == true)
          @foreach ($reactions as $reaction)
            @if ($article-> Artnr == $reaction-> reactienr)
              <font size = "2"><i>{{$reaction-> reactie}} </i></font> ,
            @endif
          @endforeach
        @endif
      @endforeach
      </center>
     </div>

   </div>
</body>
</html>

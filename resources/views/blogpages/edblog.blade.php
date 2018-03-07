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
     var ActCatnr = "allecats";

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

     //******************************************************************************************
     function Plaatscomment(artnr) {
       var txtcomment = "artcommentform" + artnr;
       var Inhoud = document.getElementById(txtcomment);

       alert(artnr + "," + Inhoud.value);
       if (Inhoud.value != "") {
           var xhttp = new XMLHttpRequest();
           var myURL = "edblog/post/?artnr" + artnr + "&reaction=" + Inhoud.value;
           alert(myURL);
           xhttp.open("POST", myURL, false);
           xhttp.send();
           alert(xhttp.responseText);
           Inhoud.value = "";
       }
       Selectartcat(ActCatnr);
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
          <hr><textarea id = "artcommentform{{$article-> Artnr}}"></textarea>
          <input type = "submit" name = "Plaatscomment" value = "geef reactie"
            onClick= "Plaatscomment({{$article-> Artnr}})">
          </div>
        @endif
        </div>
      @endforeach
      </center>
     </div>

   </div>
</body>
</html>

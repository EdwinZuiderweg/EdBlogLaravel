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
           if (catnr!= "allecats") {
             var myURL = "edblog/filter/" + catnr;
             xhttp.open("GET", myURL, false);
             xhttp.send();
           }
           else { //catnr == "allecats"
           var myURL = "edblog/alles/";
             xhttp.open("GET", myURL, false);
             xhttp.send();
           }
           //alert(xhttp.responseText);
           var artikeldiv = document.getElementById("divartikelen");
           //alert(xhttp.responseText);
           artikeldiv.innerHTML = xhttp.responseText;
       }
     }

     //****************************************************************************
     function Zoekartfilter() {
       var zoekfilter = document.getElementById("txtidSearchFilter");
       //alert("so far so good!");
       if (zoekfilter.value !="") {
         var filter = zoekfilter.value;
         var xhttp = new XMLHttpRequest();
         var myURL = "edblog/zoek/" + filter;
         xhttp.open("GET", myURL, false);
         xhttp.send();

         //alert(xhttp.responseText);
         var artikeldiv = document.getElementById("divartikelen");
         if (xhttp.responseText != "0" ) {
             artikeldiv.innerHTML = xhttp.responseText;
         }
         else {
            artikeldiv.innerHTML = "";
            alert("geen artikel gevonden die voldoen aan zoekfilter");
          }
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
      <center><b>Filter categorie:</b></center><br>
      @foreach ($categories as $category)
        <input type= "radio" name="categorie" value="{{$category-> catid}}" onClick = "Selectartcat({{$category-> catid}})">
          {{$category-> catnaam}}
        <br>
      @endforeach
      <input type="radio" name="categorie" value="allecats" onClick = "Selectartcat(this.value)">Alles
    </ul>
      <br><br>Zoek: <br>
      <input type = "text" name = "txtnmSearchFilter" id="txtidSearchFilter" size="25">
      <input type = "submit" name = "btnzoekfilter" value = "Zoek" size="4" onClick="JavaScript: Zoekartfilter()">
    </div>


    <div id = "divartikelen">
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
     </div>

   </div>
</body>
</html>

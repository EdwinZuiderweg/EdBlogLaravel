  <ul>
  @foreach ($categories as $category)
     <li onClick = "Selectartcat({{$category-> catid}})">{{$category-> catnaam}}</li>
  @endforeach
</ul>

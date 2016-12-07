<!DOCTYPE html>
<html lang="de">
<head>
   <style>
   body {
       font-family: Verdana, Geneva, sans-serif;
   }
   div {
       float: left;
       margin: 20px;
   }
   price{
    color: darkblue;
   }
  </style>
</head>
<body>
  <div>
      Shop<br>
      + Gewürze<br>
      + Bouillon
  </div>
  <div>
    @foreach($arrData as $item)
      <h1>{{$item['name']}}</h1>
      <price>{{$item['price']}}</price>
      @if(!empty($item['arrAdditionalAttributes']))
        <table>
        @foreach($item['arrAdditionalAttributes'] as $subItem)
          <tr>
            <td>{{$subItem['attribute_code']}}:</td>
            @if($subItem['value'] == 0)
              <td>Nein</td>
            @else
              <td>Ja</td>
            @endif
          </tr>
        @endforeach
        </table>
      @endif
    @endforeach
  </div>
</body>
</html>
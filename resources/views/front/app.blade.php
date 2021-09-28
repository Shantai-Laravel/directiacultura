<!DOCTYPE html>
<html lang="{{$lang->lang}}">

<head>
  <meta charset="utf-8">
  <meta name="_token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Direcția Cultură a Primăriei Municipiului Chișinău</title>
  <link rel="stylesheet" href="{{asset('fronts/css/resets.css')}}" />
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
        crossorigin="anonymous"/>
  <link rel="stylesheet" type="text/css" href="{{asset('fronts/css/main.min.css?qwertyuiop')}}" />
</head>

<body>

  <div id="cover">
    @yield('content')
  </div>

  @include('front.layouts.scripts')

</body>

</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <link href="{{ url(mix('/css/app.css')) }}" rel="stylesheet" type="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cart show test title</title>
  </head>
  <body>
    <cart-table id="cart-table"
      cart='{!! json_encode($viewModel["cart"], JSON_UNESCAPED_UNICODE) !!}'
      url_prefix='{{isset($urlPrefix) ? $urlPrefix : ""}}'>
    </cart-table>
  </body>
  <script src="{{ mix('js/app.js') }}"></script>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ url(mix('/css/app.css')) }}" rel="stylesheet" type="text/css">
    <title>cart form test title</title>
  </head>
  <body>
    <order-form id="order-form"
     cart='{!! json_encode($viewModel["cart"], JSON_UNESCAPED_UNICODE) !!}'
     url_prefix='{{isset($urlPrefix) ? $urlPrefix : ""}}'>
    </order-form>
  </body>
  <script src="{{ mix('js/app.js') }}"></script>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ url(mix('/css/app.css')) }}" rel="stylesheet" type="text/css">
    <title>product list test title</title>
  </head>
  <body>
    <product-list id="product-list"
     product_list='{!! json_encode($viewModel["productGroups"], JSON_UNESCAPED_UNICODE) !!}'
     url_prefix='{{isset($urlPrefix) ? $urlPrefix : ""}}'>
    </product-list>
  </body>
  <script src="{{ mix('js/app.js') }}"></script>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <link href="{{ url(mix('/css/app.css')) }}" rel="stylesheet" type="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/js/all.min.js"></script>
    <title>product detail test title</title>
  </head>
  <body>
    <product-detail id="product-detail"
     product='{!! json_encode($viewModel["productGroup"], JSON_UNESCAPED_UNICODE) !!}'
     url_prefix='{{isset($urlPrefix) ? $urlPrefix : ""}}'>
    </product-detail>
    <comments id="comments"
     comments='{!! json_encode($viewModel["reviews"], JSON_UNESCAPED_UNICODE) !!}'>
    </comments>
  </body>
  <script src="{{ mix('js/app.js') }}"></script>
</html>

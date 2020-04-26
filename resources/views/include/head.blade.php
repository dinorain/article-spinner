<title>{{ config('app.name', 'SPINTAX') }}</title>

<!-- Required meta tags always come first -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Main Font -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/webfont/1.6.28/webfontloader.js"></script>

<script>
    WebFont.load({
        google: {
            families: ['Roboto:300,400,500,700:latin']
        },
        custom: {
            families: ['Font Awesome\ 5 Icons:400,900', 'Font Awesome\ 5 Brands:400'],
            urls: ['https://use.fontawesome.com/releases/v5.11.2/css/all.css']
		},
    });
</script>

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<!-- Main Styles CSS -->
<link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/fonts.css') }}">

<!-- Plugins -->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/cropper/4.0.0/cropper.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

{{-- parsley --}}
<link rel="stylesheet" type="text/css" href="{{ asset('css/parsley.css') }}">

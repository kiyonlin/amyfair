<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Amyfair') }} - @lang('invitation.title')</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
    <b-container class="mt-5">
        <b-form-row align-h="center" method="get" action="{{route('invitation.create', ['locate' => 'en'])}}">
        @csrf    
        <b-button type="submit" variant="outline-success">我是供应商 I AM A SUPPLIER</b-button>
        </b-form-row>
        <b-row align-h="center" class="mt-5">
            <b-button variant="outline-success" @click="create('buyer')">我是采购商 I AM A PROFESSIONAL BUYER</b-button>
        </b-row>
    </b-container>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>

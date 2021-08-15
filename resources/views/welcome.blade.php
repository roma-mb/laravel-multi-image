<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    </head>
    <body class="antialiased">
        <div class="flex-center position-ref full-height" id="app">
            <example-component />
        </div>
        <div class="container">
            <div class="row">
                @foreach($images as $image)
                    <div class="col-2 mb-4">
                        <a href="{{ $image->original }}">
                            <img src="{{ $image->thumbnail }}" class="w-100">
                        </a>
                        <form action="/images/{{ $image->id }}" method="post">
                            @method('DELETE')
                            @csrf
                            <button class="small btn btn-outline-danger mt-2">Delete</button>
                        </form>
                    </div>
                @endforeach
            </div>
            <div class="row">
                <a href="{{ route('dropzone-example') }}">
                    <button type="submit" class="btn btn-dark">Dropzone Vue example</button>
                </a>
            </div>
        </div>
    </body>
    <script src="{{ mix('/js/app.js') }}"></script>
</html>

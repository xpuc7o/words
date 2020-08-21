<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Words</title>
    <link rel="stylesheet"
          href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
          integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z"
          crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
            integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
            integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
            crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col">
            <form method="post" action="/words" class="mt-5">
                @csrf
                <div class="form-group">
                    <input name="letters" type="text" id="letters" class="form-control" autofocus>
                </div>

                <button type="submit" class="btn btn-primary">Търси</button>
            </form>

            @if(session()->has('words'))
                <div class="row mt-1 mb-5">
                    @foreach(session('words')->chunk(10) as $chunk)
                        <div class="col-2 mt-3">
                            <ul class="list-group">
                                @foreach($chunk as $word)
                                    <li class="list-group-item d-flex justify-content-between align-items-center list-group-item-{{ $word->color() }}">
                                        {{ $word->name }}
                                        <span class="badge badge-pill badge-{{ $word->color() }}">{{ $word->length }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
</body>
</html>

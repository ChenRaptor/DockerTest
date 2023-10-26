<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    </head>
    <body class="antialiased">
        <style>
            form{
                color: white; 
                display: flex; 
                flex-direction: column;
            }

            form input[type="submit"]{
                margin-top: 6px;
                background-color:#FF2D20 !important;
                cursor: pointer;
                border-radius: 3px;
            }

            form input{
                color: black;
            }

            form p{
                color:#FF2D20;
            }


            #error {
                display:none;
                margin-top:1vh;
                background-color:#FF2D20;
                color:white;
                border-radius: 10px;
                padding:10px;
            }
        </style>

        <div class="mt-16">
            <form action="/changepassword/{{ $password_id }}" method="POST">
                @csrf
                <label for="newpassword">Entrer votre nouveau mot de passe</label>
                <input type="password" name="newpassword">
                <input type="submit" value="Subscribe" />
            </form>
            @if($errors->has('newpassword'))
                <p>{{$errors->first('newpassword')}}</p>
            @endif

            <p>{{ $status }}</p>
        </div>
    </body>
</html>

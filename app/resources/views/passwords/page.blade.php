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
        <x-app-layout>
            <x-slot name="header">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{__('showpassword.h1')}}
                </h2>
            </x-slot>

            <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('passwords.partials.add-password')
                    </div>
                </div>

                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg text-white">
                    <div class="max-w-xl">
                        @foreach($passwords as $password)
                            <div class="password-item">
                                <div><strong>Site Internet:</strong><p>{{ $password->site }}</p></div>
                                <div><strong>Courrier Électronique:</strong><p>{{ $password->login }}</p></div>
                                <div><strong>Mot de Passe:</strong><p>{{ $password->password }}</p>
                                <!-- <x-primary-button>{{ __('Save') }}</x-primary-button> -->
                                <a href="/changepassword/{{ $password->id }}" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md">
                                    Change password
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
                
            </div>
            </div>
        </x-app-layout>
    </body>
</html>

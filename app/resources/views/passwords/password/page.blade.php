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
						<div>
							<form method="post" action="/passwords/password/{{ $password_id }}">
								@csrf
								<div>
									<x-input-label for="newpassword" value="Mot de passe" />
									<x-text-input id="newpassword" class="block mt-1 w-full" type="text" name="newpassword" required />
								</div>

								<div class="flex items-center gap-4 mt-4">
									<x-primary-button>Modifier le mot de passe</x-primary-button>
								</div>
							</form>
						</div>
                    </div>
                </div>
            </div>
            </div>
        </x-app-layout>
    </body>
</html>


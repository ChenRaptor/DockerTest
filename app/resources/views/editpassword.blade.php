<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Modifier mon mot de passe') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 ">
                    @if ($passwordToEdit[0])
                        <form action="{{ route('editpassword.updatepwd', $passwordToEdit[0]->id) }}" method="POST">
                            @csrf
                            <div class='flex flex-col w-1/2'>
                                <label class='dark:text-gray-100' for="site"> {{ __('addpwd.link') }} </label>
                                <input value="{{ $passwordToEdit[0]->site }}" type="text" name="site"
                                    id="site" class='w-50 dark:bg-gray-800 dark:text-gray-100'>
                                @error('site')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class='flex flex-col w-1/2'>
                                <label class='dark:text-gray-100' for="login"> {{ __('addpwd.login') }} </label>
                                <input value="{{ $passwordToEdit[0]->login }}" type="text" name="login"
                                    id="login" class='w-50 dark:bg-gray-800 dark:text-gray-100'>
                                @error('login')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class='flex flex-col w-1/2'>
                                <label class='dark:text-gray-100' for="password"> {{ __('addpwd.pwd') }} </label>
                                <input value="{{ $passwordToEdit[0]->password }}" type="password" name="password"
                                    id="password" class='w-50 dark:bg-gray-800 dark:text-gray-100'>
                                <button id="eyeIcon" type="button" onclick="togglePasswordVisibility()"
                                    class="btn btn-outline-secondary dark:text-gray-100">
                                    Voir le mot de passe
                                </button>
                                @error('password')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            <button class='dark:text-gray-100' type="submit">Envoyer</button>
                        </form>
                    @else
                        <p>Erreur</p>
                    @endif
                </div>
            </div>
        </div>
        <div class="py-4">
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 ">
                    @if (!empty($teams))
                        <form action="{{ route('linkpwdteam.add', $passwordToEdit[0]->id) }}" method="POST">
                            @csrf

                            <div class='flex flex-col w-1/2'>
                                @foreach ($teams as $team)
                                    <span>
                                        <input type="checkbox" name="teams[]" value="{{ $team->id }}"
                                            id="teams">
                                        <label class='dark:text-gray-100' for="teams">{{ $team->name }}</label>
                                    </span>
                                @endforeach
                            </div>

                            <button class='dark:text-gray-100' type="submit">Lier le mot de passe avec un ou plusieurs
                                teams</button>
                        </form>
                    @else
                        <p>Pas de team ou déjà relier à toutes les teams</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <script>
        function togglePasswordVisibility() {
            let passwordInput = document.getElementById("password");
            let eyeIcon = document.getElementById("eyeIcon");

            if (passwordInput.type === "password") {
                eyeIcon.textContent = "Cacher le mot de passe";
                passwordInput.type = "text";
            } else {
                eyeIcon.textContent = "Voir le mot de passe";
                passwordInput.type = "password";
            }
        }
    </script>
</x-app-layout>

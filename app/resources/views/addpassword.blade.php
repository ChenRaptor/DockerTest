<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('addpwd.title') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 ">
                    <form action="{{ route('addpasswordreq') }}" method="POST">
                        @csrf
                        <div class='flex flex-col w-1/2'>
                            <label class='dark:text-gray-100' for="site">{{ __('addpwd.link') }}</label>
                            <input value="{{ old('site') }}" type="text" name="site" id="site"
                                class='w-50 dark:bg-gray-800 dark:text-gray-100'>
                            @error('site')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class='flex flex-col w-1/2'>
                            <label class='dark:text-gray-100' for="login">{{ __('addpwd.login') }}</label>
                            <input value="{{ old('login') }}" type="text" name="login" id="login"
                                class='w-50 dark:bg-gray-800 dark:text-gray-100'>
                            @error('login')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class='flex flex-col w-1/2'>
                            <label class='dark:text-gray-100' for="password"> {{ __('addpwd.password') }} </label>
                            <input value="{{ old('password') }}" type="password" name="password" id="password"
                                class='w-50 dark:bg-gray-800 dark:text-gray-100'>
                            @error('password')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit"> {{ __('addpwd.submit') }} </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

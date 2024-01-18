<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Ajouter un membre') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 ">
                    @if (!empty($users) && $id)
                        <form action="{{ route('addmember.add', $id) }}" method="POST">
                            @csrf
                            <div class='flex flex-col w-1/2'>
                                <label class='dark:text-gray-100' for="users"> {{ __('Ajouter un membre') }} </label>
                                <select name="users" id="users" class='w-50 dark:bg-gray-800 dark:text-gray-100'>
                                    @foreach ($users as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('users')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit">Ajouter</button>
                        </form>
                    @else
                        <p>Erreur</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

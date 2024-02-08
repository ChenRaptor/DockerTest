
 
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('team.show') }}
        </h2>
    </x-slot>

    @include('teams.store.index')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <h1 class="text-center"> {{ __('team.show') }} </h1>

                    <div>
                        @if ($datas->count() > 0)
                            @foreach ($datas as $data)
                                <article class="py-4 relative" style="border-bottom: 2px solid black">
                                    <a href="/teams/{{ $data->id }}/get" class="absolute right-0">
                                    <svg fill="white" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M200-200h57l391-391-57-57-391 391v57Zm-80 80v-170l528-527q12-11 26.5-17t30.5-6q16 0 31 6t26 18l55 56q12 11 17.5 26t5.5 30q0 16-5.5 30.5T817-647L290-120H120Zm640-584-56-56 56 56Zm-141 85-28-29 57 57-29-28Z"/></svg>
                                    </a>
                                    <h3>{{ __('team.teams_list_name') }} : {{ $data->name }}</h3>
                                </article>
                            @endforeach
                            @else 
                                <h2>{{ __('team.teams_list_no_teams') }}</h2>                    
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
        
              
        
        
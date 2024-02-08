<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('team.invite') }}
        </h2>
    </x-slot>


    @if ($datas)
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <section class="py-4">
                            <h2>{{ __('team.invite_name') }} : {{ $datas->name }}</h2>
                            @if ($datas->users)
                                <ul>
                                    @foreach ($datas->users as $people)
                                        <li>{{ $people->name }}</li>
                                    @endforeach
                                </ul> 
                            @endif   
                        </section>
                        
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if ($peoples)
        <div class="py-4">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <section class="py-4">                            
                            <form action="{{ route('team.invite', $id) }}" method="POST">
                                @csrf
                                <select name="user-to-add" class="text-gray-900" style="width: 200px; margin-right: 20px">
                                    @foreach ($peoples as $people)
                                        <option value="{{ $people->id }}">{{ $people->name }}</option>
                                    @endforeach
                                </select>
                                @error('user-to-add')
                                    <small>Error</small>
                                @enderror
                                <button type="submit" style="background: black; border-radius: 5px; padding: 10px 20px">{{ __('team.invite_to_join_submit_button') }}</button>
                            </form>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if ($passwords)
        <div class="py-4">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <section>
                            <h2>{{ __('team.team_passwords_list') }}</h2>
                            @foreach ($passwords as $data)
                                <article class="py-4">
                                    <h3 >Site : {{ $data->site }}</h3>
                                    <div>
                                        <p>{{  __('password.passwords_list_url') }}:  {{ $data->login }}</p>
                                        <p>{{  __('password.passwords_list_password') }}: {{ $data->password }}</p>
                                        <p>{{  __('password.passwords_list_creation_date') }}:  {{ $data->created_at }}</p>
                                        <p>{{  __('password.passwords_list_last_update_date') }}:  {{ $data->updated_at }}</p>
                                    </div>
                                </article>
                            @endforeach
                        </section>               
                    </div>
                </div>
            </div>
        </div>                
    @endif
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('password.update') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    @if ($datas)
                        <article class="py-4">
                            <h3>{{ __('password.update_password_site') }} : {{ $datas->site }}</h3>
                            <div>
                                <p>{{ __('password.update_password_login') }} :  {{ $datas->login }}</span></p>
                                
                                <form action="{{ route('password.updatePassword', $datas->id) }}" method="POST">
                                    @csrf                                    

                                    <div>
                                        <label>
                                            <span>{{ __('password.update_password_new_password') }}</span>
                                            <input type="password" name="newpassword" class="text-gray-800">
                                        </label>
                                        @error('newpassword')
                                            <small>{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <button type="submit">{{ __('password.update_password_submit_button') }}</button>          
                                </form> 
                            </div>
                        </article>
                    @endif


                </div>
            </div>
        </div>
    </div>
    @if ($teams)
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <article>
                            <h3>{{ __('password.update_password_link_teams') }}</h3>
                            <form action="{{ route('password.updateTeam', $datas->id) }}" method="POST" class="py-4 flex flex-col">
                                @csrf 
                                @foreach ($teams as $team)
                                    <fieldset class="px-4 py-4" style="display: inline; border-bottom: 2px solid black">
            
                                        <label>
                                            <input type="checkbox" name="team[]" value="{{ $team->id }}" {{ $team->isChecked ? 'checked' : '' }} />
                                            <span>{{$team->name}}</span>
                                        </label>

                                        @error('team[]')
                                            <small>{{ $message }}</small>
                                        @enderror
                                    </fieldset>
                                @endforeach
                                <button type="submit" class="block pt-8">{{ __('password.update_password_submit_button') }}</button>          
                            </form> 
                        </article>            
                    </div>
                </div>
            </div>
        </div>
    @endif   

</x-app-layout>


<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <form action="{{ route('team.store') }}" method="POST">
                    @csrf
                                            
                    <div>
                        <label>
                            <span>{{ __('team.store_name') }}</span>
                            <input type="text" name="name" class="text-gray-800">
                        </label>
                        @error('name')
                            <small>{{ $message }}</small>
                        @enderror
                    </div>

        
                    <button type="submit">{{ __('team.store_submit_button') }}</button>          
                </form> 
            </div>
        </div>
    </div>
</div>

      


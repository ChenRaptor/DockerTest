
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <form action="{{ route('password.stores') }}" method="POST">
                    @csrf
                    
                    <div>
                        <label>
                            <span>{{  __('password.add_password_url') }}</span>
                            <input type="text" name="url" class="text-gray-800">
                        </label>
                        @error('url')
                            <small>{{ $message }}</small>
                        @enderror
                    </div>

                    <div>
                        <label>
                            <span>{{  __('password.add_password_login') }}</span>
                            <input type="text" name="login" class="text-gray-800">
                        </label>
            
                        @error('login')
                            <small>{{ $message }}</small>
                        @enderror
                    </div>

                    <div>
                        <label>
                            <span>{{  __('password.add_password_password') }}</span>
                            <input type="password" name="pwd" class="text-gray-800">
                        </label>
            
                        @error('pwd')
                            <small>{{ $message }}</small>
                        @enderror
                    </div>
        
                    <button type="submit">{{ __('password.add_password_submit_button') }}</button>          
                </form> 
            </div>
        </div>
    </div>
</div>

      


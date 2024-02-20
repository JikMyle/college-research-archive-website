<x-shared.layout title='Reset Password'>
    
    <div class="flex flex-col md:flex-row items-center justify-center md:justify-evenly flex-grow gap-10">
        <div class='flex'>
            <p class="text-5xl font-bold text-center md:text-left text-text-light dark:text-text-dark">
                Change your <br> 
                password
            </p>
        </div>
    
        <x-input.form :showLogo='true' action='/reset-password' method='POST'>
            @method('patch')

            <div class="flex flex-col gap-3">
                <input
                    name="token"
                    type="text"
                    value="{{$token}}"
                    hidden
                />

                <x-input.text-field>
                    <x-slot:input 
                        id='email'
                        name='email'
                        placeholder='Enter your email address'
                        type='email'
                        required>
                    </x-slot:input>
                </x-input.text-field>
    
                <x-input.text-field>
                    <x-slot:input 
                        id='password'
                        name='password'
                        placeholder='Enter new password'
                        type='password'
                        required>
                    </x-slot:input>
                </x-input.text-field>

                <x-input.text-field>
                    <x-slot:input 
                        id='password_confirmation'
                        name='password_confirmation'
                        placeholder='Confirm password'
                        type='password'
                        required>
                    </x-slot:input>
                </x-input.text-field>
            </div>
            
            <x-input.button 
                class='bg-gradient-to-r from-gray-500 to-gray-800 hover:bg-none dark:bg-none dark:hover:bg-black dark:hover:text-text-dark'
                type='submit'
                required>
                Reset Password
            </x-input.button>
        </x-input.form>
    </div>
    
    </x-shared.layout>
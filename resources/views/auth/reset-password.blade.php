<x-shared.layout title='Reset Password'>
    
    <div class="flex m-auto w-full flex-col lg:flex-row items-center justify-center lg:justify-evenly">
        <div class='flex my-16'>
            <p class="z-[1] text-5xl font-bold text-center md:text-left text-text-light dark:text-text-dark">
                Change your <br> 
                password
            </p>

            <img 
                class="dark:hidden absolute -z-[1] -translate-y-1/2 scale-75 lg:scale-125"
                src="{{ asset('images/yellow-stain.svg')}}" 
                alt="">
        </div>
    
        <x-input.form 
            :showLogo='true' 
            action='/reset-password' 
            method='POST' 
            class="z-[2] my-16">

            @method('patch')

            <div class="flex flex-col gap-4">
                <input
                    name="token"
                    type="text"
                    value="{{$token}}"
                    hidden
                />

                <x-input.text-field label='Email'>
                    <x-slot:input 
                        id='email'
                        name='email'
                        placeholder='Enter your email address'
                        type='email'
                        required>
                    </x-slot:input>
                </x-input.text-field>
    
                <x-input.text-field label='New Password'>
                    <x-slot:input 
                        id='password'
                        name='password'
                        placeholder='Enter new password'
                        type='password'
                        required>
                    </x-slot:input>
                </x-input.text-field>

                <x-input.text-field label='Confirm New Password'>
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
<x-shared.layout title='Forgot Password'>
    
    <div class="flex flex-col md:flex-row items-center justify-center md:justify-evenly flex-grow gap-10">
        <div class='flex'>
            <p class="text-5xl font-bold text-center md:text-left text-text-light dark:text-text-dark">
                Let's get you into <br> 
                your account
            </p>
        </div>
    
        <x-input.form :showLogo='true' action='' method='POST'>
            <x-input.text-field>
                <x-slot:input 
                    id='email'
                    name='email'
                    placeholder='Enter your email address'
                    type='email'
                    required>
                </x-slot:input>
            </x-input.text-field>
            
            <x-input.button 
                class='bg-gradient-to-r from-gray-500 to-gray-800 hover:bg-none dark:bg-none dark:hover:bg-black dark:hover:text-text-dark'
                type='submit'
                required>
                Request Reset Code
            </x-input.button>

            <a 
                class="text-base text-placeholder dark:text-text-dark underline hover:no-underline"
                href="{{ route('login')}}">
                Back to Login
            </a>
        </x-input.form>
    </div>
    
    </x-shared.layout>
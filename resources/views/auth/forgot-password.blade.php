<x-shared.layout title='Forgot Password'>
    
    <div class="flex m-auto w-full flex-col lg:flex-row items-center justify-center lg:justify-evenly">
        <div class='flex relative my-16'>
            <p class="z-[1] text-5xl font-bold text-center md:text-left text-text-light dark:text-text-dark">
                Let's get you into <br> 
                your account
            </p>

            <img 
                class="dark:hidden absolute -z-[1] -translate-y-1/2 scale-75 lg:scale-125"
                src="{{ asset('images/yellow-stain.svg')}}" 
                alt="">
        </div>
    
        <x-input.form 
            :showLogo='true' 
            action='' 
            method='POST' 
            class="z-[2] my-16">

            <x-input.text-field class="w-80" label='Email'>
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
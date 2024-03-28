<x-shared.layout title='CCIS Archives - Sign In'>

<div class="flex m-auto w-full flex-col lg:flex-row items-center justify-center lg:justify-evenly">
    <div class='flex relative my-16'>
        <p class="z-[1] text-3xl md:text-5xl font-bold text-center md:text-left text-text-light dark:text-text-dark">
            Explore Research <br> 
            Papers and Capstones <br>
            Online!
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

        <div class="flex flex-col gap-4">
            <x-input.text-field class="w-80" label='Username or Email'>
                <x-slot:input 
                    id='email'
                    name='email'
                    placeholder='Enter username or email'
                    type='text'
                    required>
                </x-slot:input>
            </x-input.text-field>

            <x-input.text-field class="w-80" label='Password'>
                <x-slot:input 
                    id='password'
                    name='password'
                    placeholder='Enter password'
                    type='password'
                    required>
                </x-slot:input>
            </x-input.text-field>
        
            <label class="flex flex-row items-center text-base self-center text-placeholder dark:text-text-dark cursor-pointer">
                <input
                    class='w-4 h-4 mr-2 border-input-border-light dark:border-input-border-dark cursor-pointer'
                    name="remember"
                    type="checkbox">
                Stay Signed In
            </label>
        </div>

        <x-input.button 
            class='px-6 bg-gradient-to-r from-gray-500 to-gray-800 hover:bg-none dark:bg-none dark:hover:bg-black dark:hover:text-text-dark'
            type='submit'
            required>
            Sign In
        </x-input.button>
        
        <a 
            class="text-base text-placeholder dark:text-text-dark underline hover:no-underline"
            href="/forgot-password">
            Forgot Password?
        </a>
    </x-input.form>
</div>

</x-shared.layout>
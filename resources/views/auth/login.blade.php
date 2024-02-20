<x-shared.layout title='CCIS Archives - Sign In'>

<div class="flex flex-col md:flex-row items-center justify-center md:justify-evenly flex-grow gap-10">
    <div class='flex relative'>
        <p class="text-5xl font-bold text-center md:text-left text-text-light dark:text-text-dark">
            Explore Research <br> 
            Papers and Capstones <br>
            Online!
        </p>
    </div>

    <x-input.form :showLogo='true' action='' method='POST'>
        <div class="flex flex-col gap-4">
            <x-input.text-field label='Username or Email'>
                <x-slot:input 
                    id='email'
                    name='email'
                    placeholder='Enter username or email'
                    type='text'
                    required>
                </x-slot:input>
            </x-input.text-field>

            <x-input.text-field label='Password'>
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
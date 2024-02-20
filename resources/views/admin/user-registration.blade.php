<x-shared.layout title='User Registration'>
    
    <div class="flex flex-col md:flex-row items-center justify-center md:justify-evenly flex-grow gap-10">
        <div class='flex'>
            <p class="text-5xl font-bold text-center md:text-left text-text-light dark:text-text-dark">
                Register new user
            </p>
        </div>
    
        <x-input.form :showLogo='true' action='{{route("admin.users")}}' method='POST'>
            <div class="flex flex-col gap-3">
                <x-input.text-field>
                    <x-slot:input 
                        id='first_name'
                        name='first_name'
                        placeholder='First name'
                        required>
                    </x-slot:input>
                </x-input.text-field>
    
                <x-input.text-field>
                    <x-slot:input 
                        id='last_name'
                        name='last_name'
                        placeholder='Last name'
                        required>
                    </x-slot:input>
                </x-input.text-field>

                <x-input.text-field>
                    <x-slot:input 
                        id='username'
                        name='username'
                        placeholder='Username'
                        required>
                    </x-slot:input>
                </x-input.text-field>

                <x-input.text-field>
                    <x-slot:input 
                        id='email'
                        name='email'
                        placeholder='Email Address'
                        type='email'
                        required>
                    </x-slot:input>
                </x-input.text-field>

                <x-input.text-field>
                    <x-slot:input 
                        id='password'
                        name='password'
                        placeholder='Password'
                        type='password'
                        required>
                    </x-slot:input>
                </x-input.text-field>

                <x-input.text-field>
                    <x-slot:input 
                        id='password_confirmation'
                        name='password_confirmation'
                        placeholder='Confirm Password'
                        type='password'
                        required>
                    </x-slot:input>
                </x-input.text-field>

                <x-input.dropdown label='Access Level:' name='access_level'>
                    <x-slot:dropdown id="access_level" class="flex-grow">
                        <x-input.dropdown.item>
                            ...
                        </x-input.dropdown.item>

                        <x-input.dropdown.item value=0>
                            Student
                        </x-input.dropdown.item>

                        <x-input.dropdown.item value=1>
                            Admin
                        </x-input.dropdown.item>
                    </x-slot:dropdown>
                </x-input.dropdown>
            </div>

            <div class="flex flex-row justify-between gap-6">
                <a href="{{ route('admin.users') }}">
                    <x-input.button class="px-6">
                        Back
                    </x-input.button>
                </a>
                
                <x-input.button 
                    class='bg-gradient-to-r from-gray-500 to-gray-800 hover:bg-none dark:bg-none dark:hover:bg-black dark:hover:text-text-dark'
                    type='submit'
                    required>
                    Register User
                </x-input.button>
            </div>
        </x-input.form>
    </div>
    
    </x-shared.layout>
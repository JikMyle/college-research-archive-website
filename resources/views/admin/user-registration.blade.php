<x-shared.layout title='User Registration'>
    
    <div class="flex m-auto w-full flex-col lg:flex-row items-center justify-center lg:justify-evenly">
        <div class='flex relative my-16'>
            <p class="z-[1] text-5xl font-bold text-center md:text-left text-text-light dark:text-text-dark">
                Register new user
            </p>

            <img 
                class="dark:hidden absolute -z-[1] -translate-y-1/2 scale-75 lg:scale-125"
                src="{{ asset('images/yellow-stain.svg')}}" 
                alt="">
        </div>
    
        <x-input.form 
            class="z-[2] my-16"
            :showLogo='true' 
            action='{{route("admin.users")}}' 
            method='POST'>

            <x-slot:alerts>
                @if ($errors->userInfo->any())
                    <x-shared.alert 
                        type='error'
                        :messages='$errors->userInfo->all()'
                        class="basis-3/5 flex-grow"
                    />
                @endif
            </x-slot:alerts>

            <div class="flex flex-col gap-4">
                <x-input.text-field class='w-80' label='Username'>
                    <x-slot:input 
                        id='username'
                        name='username'
                        placeholder='Username'
                        required
                        autocomplete>
                    </x-slot:input>
                </x-input.text-field>

                <x-input.text-field class='w-80' label='First Name'>
                    <x-slot:input 
                        id='first_name'
                        name='first_name'
                        placeholder='First name'
                        required
                        autocomplete>
                    </x-slot:input>
                </x-input.text-field>
    
                <x-input.text-field class='w-80' label='Last Name'>
                    <x-slot:input 
                        id='last_name'
                        name='last_name'
                        placeholder='Last name'
                        required
                        autocomplete>
                    </x-slot:input>
                </x-input.text-field>

                {{-- <x-input.text-field class='w-80' label='Email'>
                    <x-slot:input 
                        id='email'
                        name='email'
                        placeholder='Email Address'
                        type='email'
                        required
                        autocomplete>
                    </x-slot:input>
                </x-input.text-field> --}}

                <x-input.text-field class='w-80' label='Password'>
                    <x-slot:input 
                        id='password'
                        name='password'
                        placeholder='Password'
                        type='password'
                        required>
                    </x-slot:input>
                </x-input.text-field>

                <x-input.text-field class='w-80' label='Confirm Password'>
                    <x-slot:input 
                        id='password_confirmation'
                        name='password_confirmation'
                        placeholder='Confirm Password'
                        type='password'
                        required>
                    </x-slot:input>
                </x-input.text-field>

                {{-- <x-input.dropdown label='Access Level:' :labelOnSide='true' name='access_level'>
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
                </x-input.dropdown> --}}
            </div>

            <div class="flex flex-row justify-between gap-6">
                <a href="{{ route('admin.users') }}">
                    <x-input.button class="px-6" type='button'>
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
<x-shared.layout title='Account Settings'>
    <div class="flex flex-grow flex-col gap-7 my-auto xl:my-0">
        <div class="flex justify-center items-center my-6">
            <img 
                class="dark:hidden w-auto h-52 object-contain"
                src="{{ asset('images/logo-light.png')}}" 
                alt="">

            <img 
                class="hidden dark:flex w-auto h-52 object-contain"
                src="{{ asset('images/logo-dark.png')}}" 
                alt="">
        </div>

        <div class="flex self-center xl:hidden w-4/5 h-auto border-b-2 border-input-border-light dark:border-input-border-dark"></div>

        <div class="flex lg:flex-grow flex-col xl:flex-row items-center justify-center lg:justify-evenly gap-10">
            <x-input.form class="w-4/5 md:w-2/5" :showLogo='false' :action='route("updateAccount")' method='post'>
                @method('patch')

                <x-slot:header>
                    <h3 class="font-bold text-4xl text-sub-text dark:text-text-dark">
                        Account Information
                    </h3>
                </x-slot:header>

                <x-slot:alerts>
                    @if ($errors->any() && session('updated') == 'info')
                        <x-shared.alert 
                            type='error'
                            :messages='$errors->all()'
                            class="w-52"
                        />

                    @elseif (session('success') && session('updated') == 'info')
                        <x-shared.alert 
                            type='success'
                            :messages='[session("success")]'
                            class="w-52"
                        />
                    @endif
                </x-slot:alerts>

                <div class="flex flex-grow flex-col items-start gap-3">
                    <x-input.text-field class="w-96">
                        <x-slot:input 
                            class="!border-0 !border-b-2 !rounded-none flex-grow"
                            id='username'
                            name='username'
                            placeholder='Username'
                            :value='$user->username'
                            required>
                        </x-slot:input>
                    </x-input.text-field>

                    <x-input.text-field class="w-96">
                        <x-slot:input 
                            class="!border-0 !border-b-2 !rounded-none flex-grow"
                            id='email'
                            name='email'
                            type='email'
                            :value='$user->email'
                            placeholder='Email Address'
                            required>
                        </x-slot:input>
                    </x-input.text-field>

                    <x-input.text-field class="w-96">
                        <x-slot:input 
                            class="!border-0 !border-b-2 !rounded-none flex-grow"
                            id='first_name'
                            name='first_name'
                            :value='$user->first_name'
                            placeholder='First Name'
                            required>
                        </x-slot:input>
                    </x-input.text-field>

                    <x-input.text-field class="w-96">
                        <x-slot:input 
                            class="!border-0 !border-b-2 !rounded-none flex-grow"
                            id='last_name'
                            name='last_name'
                            :value='$user->last_name'
                            placeholder='Last Name'
                            required>
                        </x-slot:input>
                    </x-input.text-field>
                </div>

                <x-input.button
                    name='btnUpdateInfo'
                    type='submit'
                    value='btnUpdateInfo'>
                    Save Changes
                </x-input.button>
            </x-input.form>

            <div class="flex w-4/5 h-auto xl:w-auto xl:h-4/5 border-b-2 xl:border-b-2 xl:border-r-2 border-input-border-light dark:border-input-border-dark"></div>

            <x-input.form class="w-4/5 md:w-2/5" :showLogo='false' :action='route("updateAccount")' method='post'>
                @method('patch')

                <x-slot:header>
                    <h3 class="font-bold text-4xl text-sub-text dark:text-text-dark">
                        Password Security
                    </h3>
                </x-slot:header>

                <x-slot:alerts>
                    @if ($errors->hasAny(['new_password', 'password']) || ($errors->any() && session('updated') == 'password'))
                        <x-shared.alert 
                            type='error'
                            :messages='$errors->all()'
                            class="w-52"
                        />

                    @elseif (session('success') && session('updated') == 'password')
                        <x-shared.alert 
                            type='success'
                            :messages='[session("success")]'
                            class="w-52"
                        />
                    @endif
                </x-slot:alerts>

                <div class="flex flex-grow flex-col items-start gap-3">
                    <x-input.text-field class="w-96">
                        <x-slot:input 
                            class="!border-0 !border-b-2 !rounded-none flex-grow"
                            id='password'
                            name='password'
                            type='password'
                            placeholder='Current Password'
                            value=''
                            required>
                        </x-slot:input>
                    </x-input.text-field>

                    <x-input.text-field class="w-96">
                        <x-slot:input 
                            class="!border-0 !border-b-2 !rounded-none flex-grow"
                            id='new_password'
                            name='new_password'
                            type='password'
                            placeholder='New Password'
                            value=''
                            required>
                        </x-slot:input>
                    </x-input.text-field>

                    <x-input.text-field class="w-96">
                        <x-slot:input 
                            class="!border-0 !border-b-2 !rounded-none flex-grow"
                            id='new_password_confirmation'
                            name='new_password_confirmation'
                            type='password'
                            placeholder='Confirm New Password'
                            value=''
                            required>
                        </x-slot:input>
                    </x-input.text-field>
                </div>

                <x-input.button
                    name='btnUpdatePassword'
                    type='submit'
                    value='btnUpdatePassword'>
                    Change Password
                </x-input.button>
            </x-input.form>
        </div>
    </div>
</x-shared.layout>
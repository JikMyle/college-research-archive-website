<x-shared.layout title='Account Settings'>
    <div class="flex w-full h-auto flex-col lg:flex-row flex-wrap items-center lg:items-start lg:justify-evenly gap-7 my-auto lg:my-auto">
        <x-shared.logo class="justify-center w-full mb-4"></x-logo>

        <div class="flex w-4/5 lg:hidden border-b-2 border-input-border-light dark:border-input-border-dark"></div>

        <x-input.form 
            class="w-4/5 md:w-2/5 max-sm:self-center" 
            :showLogo='false' 
            :action='route("updateAccount")' 
            method='post'>

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

            <div class="flex flex-col w-3/5 items-center gap-5">
                <x-input.text-field 
                    class="w-full"
                    label='Username'>

                    <x-slot:input 
                        class="!border-0 !border-b-2 !rounded-none w-full"
                        id='username'
                        name='username'
                        placeholder='Username'
                        :value='$user->username'
                        required>
                    </x-slot:input>
                </x-input.text-field>

                <x-input.text-field 
                    class="w-full"
                    label='Email'>

                    <x-slot:input 
                        class="!border-0 !border-b-2 !rounded-none w-full"
                        id='email'
                        name='email'
                        type='email'
                        :value='$user->email'
                        placeholder='Email Address'
                        required>
                    </x-slot:input>
                </x-input.text-field>

                <x-input.text-field 
                    class="w-full"
                    label='First Name'>

                    <x-slot:input 
                        class="!border-0 !border-b-2 !rounded-none w-full"
                        id='first_name'
                        name='first_name'
                        :value='$user->first_name'
                        placeholder='First Name'
                        required>
                    </x-slot:input>
                </x-input.text-field>

                <x-input.text-field 
                    class="w-full"
                    label='Last Name'>

                    <x-slot:input 
                        class="!border-0 !border-b-2 !rounded-none w-full"
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

        <div class="flex w-4/5 h-auto lg:w-auto lg:self-stretch border-b-2 lg:border-b-2 lg:border-r-2 border-input-border-light dark:border-input-border-dark"></div>

        <x-input.form 
            class="w-4/5 md:w-2/5" 
            :showLogo='false' 
            :action='route("updateAccount")' 
            method='post'>

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

            <div class="flex w-3/5 flex-col items-start gap-5">
                <x-input.text-field 
                    class="w-full"
                    label='Current Password'>

                    <x-slot:input 
                        class="!border-0 !border-b-2 !rounded-none w-full"
                        id='password'
                        name='password'
                        type='password'
                        placeholder='Current Password'
                        value=''
                        required>
                    </x-slot:input>
                </x-input.text-field>

                <x-input.text-field 
                    class="w-full"
                    label='New Password'>

                    <x-slot:input 
                        class="!border-0 !border-b-2 !rounded-none w-full"
                        id='new_password'
                        name='new_password'
                        type='password'
                        placeholder='New Password'
                        value=''
                        required>
                    </x-slot:input>
                </x-input.text-field>

                <x-input.text-field 
                    class="w-full"
                    label='Confirm New Password'>

                    <x-slot:input 
                        class="!border-0 !border-b-2 !rounded-none w-full"
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
</x-shared.layout>
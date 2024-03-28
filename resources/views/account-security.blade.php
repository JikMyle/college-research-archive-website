<x-shared.layout title='Account Settings'>
    <div class="flex w-full h-auto flex-col lg:flex-row flex-wrap items-center lg:items-start lg:justify-evenly gap-7 my-auto">
        <x-shared.logo class="justify-center w-full mt-4"></x-logo>

        <div class="flex w-4/5 lg:hidden border-b-2 border-input-border-light dark:border-input-border-dark"></div>

        <x-input.form 
            class="w-3/5 lg:w-96" 
            :showLogo='false' 
            :action='route("updatePassword")' 
            method='post'>

            @method('patch')

            <x-slot:header>
                <h3 class="w-full text-center lg:text-start font-bold text-4xl text-sub-text dark:text-text-dark">
                    Password Security
                </h3>
            </x-slot:header>

            <x-slot:alerts>
                @if ($errors->userPassword->any())
                    <x-shared.alert 
                        type='error'
                        :messages='$errors->userPassword->all()'
                        class="basis-3/5 flex-grow"
                    />

                @elseif (session('success') && session('updated') == 'password')
                    <x-shared.alert 
                        type='success'
                        :messages='[session("success")]'
                        class="basis-3/5 flex-grow"
                    />
                @endif
            </x-slot:alerts>

            <div class="flex w-full flex-col items-start gap-5">
                <x-input.text-field 
                    class="w-full"
                    label='Current Password'>

                    <x-slot:input 
                        class="!border-0 !border-b-2 !rounded-none !pt-1"
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
                        class="!border-0 !border-b-2 !rounded-none !pt-1"
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
                        class="!border-0 !border-b-2 !rounded-none !pt-1"
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
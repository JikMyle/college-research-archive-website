<x-shared.layout title='User Database'>

<div class="flex flex-grow flex-col items-center">
    <div class="flex mb-6 mt-9 text-5xl font-bold tracking-tighter text-placeholder dark:text-text-dark">
        @if (isset($results)) 
            Users found: {{$results->total()}}
        @else
            No users found
        @endif
    </div>

    <x-input.search-bar/>
    
    <div class="flex flex-col my-9 w-4/5 2xl:w-auto">

        {{-- Alerts --}}
        <div class="flex">
            @if (session('success'))
                <x-shared.alert
                    type='success'
                    :messages='[session("success")]'
                    class="flex-grow my-3 p-3"/>
            @elseif (!$errors->isEmpty())
                <x-shared.alert
                    type='error'
                    :messages='$errors->all()'
                    class="flex-grow my-3 p-3"/>
            @endif
        </div>

        {{-- Database Action Buttons --}}
        <div class="flex flex-row justify-between my-3">
            <div class="flex flex-row gap-3">
                <a href="{{ route('admin.registerUser') }}">
                    <x-input.button
                        :icon='asset("icons/icons.svg#gg-add-r")'
                        iconAlt='Rounded border plus icon'>
                        Add User
                    </x-input.button>
                </a>
                
                @if (Request::get('showTrash'))
                    <form 
                        id="restoreUsersForm"
                        action="{{ route('admin.restoreUser') }}" 
                        method="post">

                        @csrf
                        @method('patch')

                        <x-input.button
                            :icon='asset("icons/icons.svg#gg-undo")'
                            iconAlt='Undo icon'
                            class="button-restore"
                            type='submit'
                            data-multi-select='User'
                            data-action='Restore'>
                            Restore User/s
                        </x-input.button>
                    </form>
                @endif

                <form 
                    id="deleteUsersForm"
                    action="{{ route('admin.deleteUser') }}" 
                    method="post">

                    @csrf
                    @method('delete')

                    <x-input.button
                        :icon='asset("icons/icons.svg#gg-trash")'
                        iconAlt='Trash icon'
                        class="button-delete"
                        type='submit'
                        data-multi-select='User'
                        :data-action='(Request::get("showTrash")) ? "Delete Forever" : "Delete"'>
                        {{(Request::get("showTrash")) ? "Delete Forever User/s" : "Delete User/s"}}
                    </x-input.button>
                </form>

                <form 
                    class="hidden"
                    id="updateAccessForm"
                    action="{{ route('admin.updateAccess') }}" 
                    method="post">

                    @csrf
                    @method('patch')
                </form>
            </div>

            <div class="flex flex-row items-center">
                <label 
                    class="text-base text-text-light dark:text-text-dark mr-3"
                    for="itemsPerPage">
                    Items Per Page: 
                </label>
                <select 
                    class="p-1 text-base text-text-light dark:text-text-dark bg-white dark:bg-transparent border-2 border-input-border-light dark:border-input-border-dark rounded-lg"
                    name="itemsPerPage" 
                    id="itemsPerPage"
                    form="searchBar">

                    <option
                        class="text-text-light" 
                        value="10">
                        10
                    </option>

                    <option 
                        class="text-text-light"
                        value="25"
                        @if (Request::get('itemsPerPage') == 25) selected @endif>
                        25
                    </option>

                    <option 
                        class="text-text-light"
                        value="50"
                        @if (Request::get('itemsPerPage') == 50) selected @endif>
                        50
                    </option>

                    <option 
                        class="text-text-light"
                        value="100"
                        @if (Request::get('itemsPerPage') == 100) selected @endif>
                        100
                    </option>
                </select>
            </div>
        </div>

        <div id="database" data-resource='User' class="flex w-[80vw] md:w-auto self-stretch xl:self-center overflow-auto">
            <table class="w-full">
                <tr class="border-y-divider-light dark:border-y-divider-dark border-y-2">
                    <th class=""> 
                        <input 
                            type="checkbox" 
                            data-select-all='User' 
                            data-input-selector='input[name="userIds[]"]'>
                    </th>
                    <th class="align-center text-center text-text-light dark:text-text-dark font-bold text-lg leading-5 px-2 py-3">ID</th>
                    <th class="align-center text-center text-text-light dark:text-text-dark font-bold text-lg leading-5 px-10 py-3">Username</th>
                    <th class="align-center text-center text-text-light dark:text-text-dark font-bold text-lg leading-5 px-10 py-3">Email</th>
                    <th class="align-center text-center text-text-light dark:text-text-dark font-bold text-lg leading-5 px-6 py-3">Access Level</th>
                    <th class="align-center text-center text-text-light dark:text-text-dark font-bold text-lg leading-5 px-10 py-3">First Name</th>
                    <th class="align-center text-center text-text-light dark:text-text-dark font-bold text-lg leading-5 px-10 py-3">Last Name</th>
                    <th class="align-center text-center text-text-light dark:text-text-dark font-bold text-lg leading-5 px-10 py-3">Date Registered</th>
                    <th></th>
                </tr>

                @foreach ($results as $user)
                    <tr class="border-b-divider-light dark:border-b-gray-900 border-y-2">
                        <td class="align-center text-center p-3">
                            <input 
                                class="cb{{$user->id}}"
                                type="checkbox"
                                name="userIds[]"
                                value="{{ $user->id }}"
                                data-resource='User'>

                            <input 
                                class="cb{{$user->id}} hidden"
                                type="checkbox"
                                name="userIds[]"
                                value="{{ $user->id }}"
                                form="deleteUsersForm">

                            @if (Request::get('showTrash'))
                                <input 
                                    class="cb{{$user->id}} hidden"
                                    type="checkbox"
                                    name="userIds[]"
                                    value="{{ $user->id }}"
                                    form='restoreUsersForm'>
                            @else
                                <input 
                                    class="cb{{$user->id}} hidden"
                                    type="checkbox"
                                    name="userIds[]"
                                    value="{{ $user->id }}"
                                    form="updateAccessForm">
                            @endif
                        </td>
                        <td class="text-center align-center text-text-light dark:text-text-dark font-base">{{ $user->id }}</td>
                        <td class="text-center align-center text-text-light dark:text-text-dark font-base">{{ $user->username }}</td>
                        <td class="text-center align-center text-text-light dark:text-text-dark font-base">{{ $user->email }}</td>
                        <td class="text-center align-center text-text-light dark:text-text-dark font-base">{{ ($user->is_admin) ? 'Admin' : 'Student' }}</td>
                        <td class="text-center align-center text-text-light dark:text-text-dark font-base">{{ $user->first_name }}</td>
                        <td class="text-center align-center text-text-light dark:text-text-dark font-base">{{ $user->last_name }}</td>
                        <td class="text-center align-center text-text-light dark:text-text-dark font-base">{{ $user->created_at }}</td>
                        
                        {{-- Single Row Action Buttons --}}
                        <td class="text-center align-center p-2">
                            <div class="flex flex-row flex-wrap items-center justify-between gap-2 w-full">
                                @if (!Request::get('showTrash'))
                                    @if ($user->is_admin)
                                        <x-input.button
                                            class="w-min leading-5 justify-center 2xl:w-auto 2xl:flex-grow"
                                            data-update-access-button
                                            data-access-level=0
                                            data-form="updateAccessForm"
                                            data-input-selector='cb{{$user->id}}'>
                                            To Student
                                        </x-input.button>
                                    @else
                                        <x-input.button
                                            class="w-min leading-5 justify-center 2xl:w-auto 2xl:flex-grow"
                                            data-update-access-button
                                            data-access-level=1
                                            data-form="updateAccessForm"
                                            data-input-selector='cb{{$user->id}}'>
                                            To Admin
                                        </x-input.button>
                                    @endif

                                @else
                                    <x-input.button
                                        :icon='asset("icons/icons.svg#gg-undo")'
                                        iconAlt='Undo Icon'
                                        class="button-restore"
                                        form="restoreUsersForm"
                                        data-single-submit
                                        data-input-selector='cb{{$user->id}}'/>
                                @endif

                                <x-input.button
                                    :icon='asset("icons/icons.svg#gg-trash")'
                                    iconAlt='Trash Icon'
                                    class="button-delete"
                                    form="deleteUsersForm"
                                    data-single-submit
                                    data-input-selector='cb{{$user->id}}'/>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>

        {{-- Pagination --}}
        <div class="py-9">
            {{ $results->withQueryString()->onEachSide(1)->links() }}
        </div>
    </div>
</div>

</x-shared.layout>
<x-admin-layout>

    <div class="py-12 w-full">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-2">
                <div class="flex p-2 bg-gray-100">
                    <a href="{{route('admin.users.index')}}" class="px-4 py-2 bg-gray-500 text-white hover:bg-gray-700
                    text-slate-100 rounded-md">Users index</a>
                </div>
                <div class="flex flex-col p-2 bg-gray-100">
                    <div>User name: {{$user->name}}</div>
                    <div>User email: {{$user->email}}</div>
                </div>
                <div class="mt-6 p-2 bg-gray-100">
                    <h2 class="text-2xl font-semibold">Roles</h2>
                    <div class="flex space-x-2 mt-4 p-2">
                        @if ($user->roles)
                            @foreach ($user->roles as $user_role)
                                <form class="px-4 py-2 bg-red-500 hover:bg-red-700 text-white rounded-md" method="POST"
                                      action="{{ route('admin.users.roles.remove', [$user->id, $user_role->id]) }}"
                                      onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">{{ $user_role->name }}</button>
                                </form>
                            @endforeach
                        @endif
                    </div>
                    <div class="max-w-xl mt-6">
                        <form method="POST" action="{{ route('admin.users.roles', $user->id) }}">
                            @csrf
                            <div class="sm:col-span-6">
                                <label for="role" class="block text-sm font-medium text-gray-700">Roles</label>
                                <select id="role" name="role" autocomplete="role-name"
                                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md
                                    shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('role')
                            <span class="text-red-400 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="sm:col-span-6 pt-5">
                        <button type="submit"
                                class="px-4 py-2 bg-gray-500 hover:bg-gray-700 rounded-md text-white">Assign
                        </button>
                    </div>
                </div>
                <div class="mt-6 p-2 bg-gray-100">
                    <h2 class="text-2xl font-semibold">Permissions</h2>
                    <div class="flex space-x-2 mt-4 pt-2">
                        @if($user->permissions)
                            @foreach($user->permissions as $user_permission)
                                <form
                                    class="px-4 py-2 bg-red-500 hover:bg-red-700 text-white rounded-md"
                                    method="POST"
                                    action="{{route('admin.users.permissions.revoke', [$user->id, $user_permission->id])}}"
                                    onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">{{$user_permission->name}}</button>
                                </form>
                            @endforeach
                        @endif
                    </div>
                    <div>
                        <form method="POST" action="{{ route('admin.users.permissions', $user->id) }}">
                            @csrf
                            @method('POST')
                            <div class="sm:col-span-6">
                                <label for="permission"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Permission</label>
                                <select id="permission" name="permission" autocomplete="permission-name"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    @foreach($permissions as $permission)
                                        <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                                    @endforeach
                                </select>
                                @error('name') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                            </div>
                            <div class="sm:col-span-6 pt-5">
                                <button type="submit"
                                        class="px-4 py-2 bg-gray-500 hover:bg-gray-700 text-white rounded-md">Assign
                                    Permission
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-admin-layout>

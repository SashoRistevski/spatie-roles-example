<x-admin-layout>

    <div class="py-12 w-full">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-2">
                <div class="flex p-2">
                    <a href="{{route('admin.roles.index')}}"
                       class="px-4 py-2 bg-gray-500 hover:bg-gray-700 text-slate-100 rounded-md">Roles index</a>
                </div>
                <div class="flex flex-col p-2">
                    <div class="space-y-8 divide-y divide-gray-200 w-1/2 mt-10">
                        <form method="POST" action="{{ route('admin.roles.update', $role->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="sm:col-span-6">
                                <label for="name" class="block text-sm font-medium text-gray-700"> Role name</label>
                                <div class="mt-1">
                                    <input type="text"
                                           id="name"
                                           name="name"
                                           class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                                           value="{{$role->name}}"/>
                                </div>
                                @error('name') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                            </div>
                            <div class="sm:col-span-6 pt-5">
                                <button type="submit"
                                        class="px-4 py-2 bg-gray-500 hover:bg-gray-700 text-white rounded-md">Update
                                    Role
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="mt-6 p-2 bg-gray-100">
                    <h2 class="text-2xl font-semibold">Role Permissions</h2>
                    <div class="flex space-x-2 mt-4 pt-2">
                        @if($role->permissions)
                            @foreach($role->permissions as $role_permission)
                                <form
                                    class=" px-4 py-2 bg-red-500 hover:bg-red-700 text-white rounded-md"
                                    method="POST"
                                    action="{{route('admin.roles.permissions.revoke', [$role->id, $role_permission->id])}}"
                                    onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">{{$role_permission->name}}</button>
                                </form>
                            @endforeach
                        @endif
                    </div>
                    <div>
                        <form method="POST" action="{{ route('admin.roles.permissions', $role->id) }}">
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

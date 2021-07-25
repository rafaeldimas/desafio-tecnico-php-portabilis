<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('dashboard.users') }}">
                        @csrf

                        <div class="sm:flex">
                            <div class="w-full sm:w-1/4 mx-2">
                                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <input
                                        type="text"
                                        name="name"
                                        id="name"
                                        class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-7 pr-12 sm:text-sm border-gray-300 rounded-md"
                                        value="{{ request('name') }}"
                                    >
                                </div>
                            </div>

                            <div class="w-full sm:w-1/4 mx-2">
                                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <input
                                        type="text"
                                        name="email"
                                        id="email"
                                        class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-7 pr-12 sm:text-sm border-gray-300 rounded-md"
                                        value="{{ request('email') }}"
                                    >
                                </div>
                            </div>

                            <div class="w-full sm:w-1/4 mx-2">
                                <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <input
                                        type="text"
                                        name="role"
                                        id="role"
                                        class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-7 pr-12 sm:text-sm border-gray-300 rounded-md"
                                        value="{{ request('role') }}"
                                    >
                                </div>
                            </div>

                            <div class="w-full sm:w-1/4 mx-2">
                                <label for="order" class="block text-sm font-medium text-gray-700">Order</label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <select
                                        name="order"
                                        id="order"
                                        class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-7 pr-12 sm:text-sm border-gray-300 rounded-md"
                                    >
                                        <option value="" selected disabled>Select Field</option>
                                        <option value="name-asc" @if(request('order') === 'name-asc') selected @endif>Name/Asc</option>
                                        <option value="name-desc" @if(request('order') === 'name-desc') selected @endif>Name/Desc</option>
                                        <option value="email-asc" @if(request('order') === 'email-asc') selected @endif>Email/Asc</option>
                                        <option value="email-desc" @if(request('order') === 'email-desc') selected @endif>Email/Desc</option>
                                        <option value="role-asc" @if(request('order') === 'role-asc') selected @endif>Role/Asc</option>
                                        <option value="role-desc" @if(request('order') === 'role-desc') selected @endif>Role/Desc</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="mt-3 text-right">
                            <a href="{{ route('dashboard.users') }}" class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:bg-gray-200">
                                Reset
                            </a>

                            <button type="submit" class="ml-2 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Search
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="py-12 max-w-7xl mx-auto flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Name
                                </th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Email
                                </th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Role
                                </th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Send Message
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($users as $user)
                            <tr>
                                <td class="px-6 text-center py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $user->name }}
                                    </div>
                                </td>
                                <td class="px-6 text-center py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $user->email }}
                                    </div>
                                </td>
                                <td class="px-6 text-center py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ optional($user->role)->name }}
                                </td>
                                <td class="px-6 text-center py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="#" class="text-indigo-600 hover:text-indigo-900">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width={2} d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

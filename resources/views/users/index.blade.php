<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            User
        </h2>
        <x-anchor href="{{ route('users.create') }}">create</x-anchor>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white">
                    <table class="table-auto w-full">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 text-emerald-600">Name</th>
                                <th class="px-4 py-2 text-emerald-600">Email</th>
                                <th class="px-4 py-2 text-emerald-600">Role</th>
                                <th class="px-4 py-2 text-emerald-600">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td class="border border-emerald-500 px-4 py-2 text-emerald-600 font-medium">{{ $user->name }}</td>
                                <td class="border border-emerald-500 px-4 py-2 text-emerald-600 font-medium">{{ $user->email }}</td>
                                <td class="border border-emerald-500 px-4 py-2 text-emerald-600 font-medium">{{ config('global.roles.'.$user->role_id) }}</td>
                                <td class="border border-emerald-500 px-4 py-2 text-emerald-600 font-medium">
                                    <div class="text-center">
                                        <x-anchor href="{{ route('users.edit', $user) }}">Edit</x-anchor>
                                        @if(auth()->user()->id !== $user->id)
                                            <form class="inline-flex" action="{{ route('users.destroy', $user) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <x-button type="submit">Delete</x-button>
                                            </form>
                                        @endif
                                    </div>
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

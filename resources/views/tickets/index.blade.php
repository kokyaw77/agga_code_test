<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tickets') }}
        </h2>
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
                                <th class="px-4 py-2 text-emerald-600">Phone</th>
                                <th class="px-4 py-2 text-emerald-600">Type</th>
                                <th class="px-4 py-2 text-emerald-600">Status</th>
                                <th class="px-4 py-2 text-emerald-600">Developer</th>
                                <th class="px-4 py-2 text-emerald-600">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tickets as $ticket)
                                <tr>
                                    <td class="border border-emerald-500 px-4 py-2 text-emerald-600 font-medium">{{ $ticket->name }}</td>
                                    <td class="border border-emerald-500 px-4 py-2 text-emerald-600 font-medium">{{ $ticket->email }}</td>
                                    <td class="border border-emerald-500 px-4 py-2 text-emerald-600 font-medium">{{ $ticket->phone }}</td>
                                    <td class="border border-emerald-500 px-4 py-2 text-emerald-600 font-medium">{{ $ticket->type }}</td>
                                    <td class="border border-emerald-500 px-4 py-2 text-emerald-600 font-medium">{{ $ticket->status }}</td>
                                    <td class="border border-emerald-500 px-4 py-2 text-emerald-600 font-medium">
                                        @foreach($ticket->developers as $developer)
                                            {{ $developer->name }}{{ (!($loop->last)) ? ',' : '' }}
                                        @endforeach
                                    </td>
                                    <td class="border border-emerald-500 px-4 py-2 text-emerald-600 font-medium">
                                        <div class="text-center ">
                                            <x-anchor href="{{ route('tickets.edit', $ticket) }}">Edit</x-anchor>
                                            <form class="inline-flex" action="{{ route('tickets.destroy', $ticket) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <x-button type="submit">Delete</x-button>
                                            </form>
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

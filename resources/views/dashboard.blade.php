<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
        <x-anchor href="#">create</x-anchor>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white">
                    <table class="table-auto w-full">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 text-emerald-600">Title</th>
                                <th class="px-4 py-2 text-emerald-600">Author</th>
                                <th class="px-4 py-2 text-emerald-600">Views</th>
                                <th class="px-4 py-2 text-emerald-600">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="border border-emerald-500 px-4 py-2 text-emerald-600 font-medium">Intro to CSS</td>
                                <td class="border border-emerald-500 px-4 py-2 text-emerald-600 font-medium">Adam</td>
                                <td class="border border-emerald-500 px-4 py-2 text-emerald-600 font-medium">858</td>
                                <td class="border border-emerald-500 px-4 py-2 text-emerald-600 font-medium">
                                    <div class="text-center">
                                        <x-anchor href="#">Edit</x-anchor>
                                        <x-anchor href="#">Delete</x-anchor>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>

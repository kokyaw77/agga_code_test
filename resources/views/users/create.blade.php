<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Developers') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white">
                    <form method="POST" action="{{ route('users.store') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Name</label>

                            <div class="columns-md">
                                <input id="name" type="text" class="w-full form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">Email</label>

                            <div class="columns-md">
                                <input id="email" type="email" class="w-full form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="role_id" class="col-md-4 col-form-label text-md-end">Roles</label>

                            <div class="columns-md">
                                <select name="role_id" id="role_id" class="form-select px-4 py-3 rounded-full w-full form-control @error('role_id') is-invalid @enderror">
                                    <option>Choose role</option>
                                    @foreach(config('global.roles') as $key => $val)
                                        <option value="{{ $key }}">{{ $val }}</option>
                                    @endforeach
                                </select>
                                @error('role_id')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">Password</label>

                            <div class="columns-md">
                                <input id="password" type="password" class="w-full form-control @error('password') is-invalid @enderror" name="password" required autofocus>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0 flex justify-end">
                            <div class="col-md-10 offset-md-4">
                                <x-button type="submit" class="btn btn-close-white">
                                    Cancel
                                </x-button>
                                <x-button type="submit" class="btn btn-primary">
                                    Submit
                                </x-button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>

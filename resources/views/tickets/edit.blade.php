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
                    <form method="POST" action="{{ route('tickets.update', $ticket) }}">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Name</label>

                            <div class="columns-md">
                                <input id="name" type="text" class="w-full form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? $ticket->name }}" required autocomplete="name" autofocus>
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
                                <input id="email" type="email" class="w-full form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') ?? $ticket->email }}" required autocomplete="email" autofocus>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="phone" class="col-md-4 col-form-label text-md-end">Phone</label>

                            <div class="columns-md">
                                <input id="phone" type="text" class="w-full form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') ?? $ticket->phone }}" required autocomplete="phone" autofocus>
                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="type" class="col-md-4 col-form-label text-md-end">Ticket Types</label>

                            <div class="columns-md">
                                <select name="type" id="type" class="form-select px-4 py-3 rounded-full w-full form-control @error('type') is-invalid @enderror">
                                    <option>Choose ticket types</option>
                                    @foreach(config('global.ticket_types') as $key => $val)
                                        <option value="{{ $key }}">{{ $val }}</option>
                                    @endforeach
                                </select>
                                @error('type')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="status" class="col-md-4 col-form-label text-md-end">Status</label>

                            <div class="columns-md">
                                <select name="status" id="status" class="form-select px-4 py-3 rounded-full w-full form-control @error('status') is-invalid @enderror">
                                    <option>Choose Status</option>
                                    @foreach(config('global.ticket_status') as $key => $val)
                                        <option value="{{ $key }}">{{ $val }}</option>
                                    @endforeach
                                </select>
                                @error('status')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <h1>Check the developers for the ticket</h1>
                        @foreach($developers as $developer)
                            <div class="row mb-3">
                                <input id="developer" type="checkbox" name="developers[]" value="{{ $developer->id }}" required autocomplete="developer" autofocus>
                                <label for="status" class="col-md-4 col-form-label text-md-end">{{ $developer->name }}</label>
                            </div>
                        @endforeach

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

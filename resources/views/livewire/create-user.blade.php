<div class="container" style="padding-top: 30px">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Crear Usuario</h2>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="save">
                        <div class="row">
                            <div class="col-md-12">
                                <x-label for="name" value="{{ __('Nombres') }}" />
                                <x-input id="name" class="block mt-1 w-full" type="text"
                                    wire:model="firstname" autofocus autocomplete="name" />
                                @error('firstname')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <x-label for="name" value="{{ __('Apellidos') }}" />
                                <x-input id="name" class="block mt-1 w-full" type="text" wire:model="lastname"
                                    autofocus autocomplete="name" />
                                @error('lastname')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <x-label for="name" value="{{ __('Email') }}" />
                                <x-input id="name" class="block mt-1 w-full" type="text" wire:model="email"
                                    autofocus autocomplete="name" />
                                @error('email')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                            <div class="col-md-6 mt-4">
                                <x-label for="password" value="{{ __('Contraseña') }}" />
                                <x-input id="password" class="block mt-1 w-full" type="password" wire:model="password"
                                    autocomplete="new-password" />
                                @error('password')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>

                            <div class="col-md-6 mt-4">
                                <x-label for="password_confirmation" value="{{ __('Confirmar Contraseña') }}" />
                                <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                                    wire:model="password_confirmation" autocomplete="new-password" />
                                @error('password_confirmation')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>

                            <div class="col-md-12 mt-2 mb-4">
                                <x-label for="role" value="{{ __('Role') }}" />
                                <select wire:model="role" class="form-select">
                                    <option value="Worker">Administrador</option>
                                    <option value="Medico">Médico</option>
                                </select>
                            </div>

                            <div class="text-center mt-3 mb-3">
                                <x-button class="ml-4">
                                    {{ __('Crear Usuario') }}
                                </x-button>
                                <a href="{{ url('/users') }}">
                                    <x-button type="button" class="ml-4">Regresar</x-button>
                                </a>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

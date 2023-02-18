<div class="container" style="padding-top: 30px">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Editar Usuario</h2>
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

                            <div class="text-center mt-3 mb-3">
                                <x-button class="ml-4">
                                    {{ __('Editar Usuario') }}
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

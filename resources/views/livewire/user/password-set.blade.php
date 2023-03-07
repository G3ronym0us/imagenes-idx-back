<x-authentication-card>
    <x-slot name="logo">
        <img src="{{ asset('logo.png') }}">
    </x-slot>

    <form wire:submit.prevent="save">
        @csrf

        <div class="col-md-12 mt-4">
            <x-label for="password" value="{{ __('Contraseña') }}" />
            <x-input id="password" class="block mt-1 w-full" type="password" wire:model="password"
                autocomplete="new-password" />
            @error('password')
                <span class="text-danger"> {{ $message }} </span>
            @enderror
        </div>

        <div class="col-md-12 mt-4">
            <x-label for="password_confirmation" value="{{ __('Confirmar Contraseña') }}" />
            <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                wire:model="password_confirmation" autocomplete="new-password" />
            @error('password_confirmation')
                <span class="text-danger"> {{ $message }} </span>
            @enderror
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-button class="ml-4">
                {{ __('Guardar') }}
            </x-button>
        </div>
    </form>
</x-authentication-card>

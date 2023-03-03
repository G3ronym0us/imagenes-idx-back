<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card">
            <div class="card-header">
                <h3 class="text-center">Subir archivos de resultados</h2>
            </div>
            <div class="card-body">
                <div class="row justify-content-center align-items-center">

                    <div class="col-md-12">
                        @error('mensaje')
                            <div class="alert alert-success">
                                <p class="text-center">{{ $message }}</p>
                            </div>
                        @enderror

                        @error('error')
                            <div class="alert alert-danger">
                                <p class="text-center">{{ $message }}</p>
                            </div>
                        @enderror

                        <div class="row justify-content-center align-items-center">

                            <div class="col-md-12">
                                <form wire:submit.prevent="save">
                                    @csrf
                                    <div class="">
                                        <div class="mb-3">
                                            <input type="text" placeholder="Numero de Documento"
                                                class="form-control input-md" wire:model="documentNumber">
                                            @error('documentNumber')
                                                <span class="text-danger"> {{ $message }} </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- Text input-->
                                    <div class="">
                                        <div class="mb-3">
                                            <input type="text" placeholder="Codigo" class="form-control input-md"
                                                wire:model="code">
                                            @error('code')
                                                <span class="text-danger"> {{ $message }} </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <p class="text-end">
                                        <button type="button" wire:click="$emit('consultar')"
                                            class="btn btn-primary">Consultar</button>
                                    </p>
                                    <!-- Text input-->
                                    <div class="">
                                        <div class="mb-3" x-data="{ isUploading: false, progress: 0 }"
                                            x-on:livewire-upload-start="isUploading = true"
                                            x-on:livewire-upload-finish="isUploading = false"
                                            x-on:livewire-upload-error="isUploading = false"
                                            x-on:livewire-upload-progress="progress = $event.detail.progress"
                                        >
                                            <label for="archivos">Archivos</label>
                                            <input wire:model="file" type="file" multiple
                                                class="form-control input-md">
                                            @error('files')
                                                <span class="text-danger"> {{ $message }} </span>
                                            @enderror
                                            <div class="progress" x-show="isUploading">
                                                <div class="progress-bar" role="progressbar" x-bind:style="`width: ${progress}%`" x-bind:aria-valuenow="`${progress}`" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div>
                                            @if ($filesUploaded)
                                                <h4>Archivos Cargados:</h4>
                                                <p>
                                                    @foreach ($filesUploaded as $index => $file)
                                                        <p>
                                                            <img src="{{ asset('icons/file-earmark-arrow-up.svg') }}">
                                                            <span>{{ $file->name }}</span>
                                                            <img src="{{ asset('icons/file-earmark-x.svg') }}" wire:click="deleteFileUploaded({{ $file->id }}, {{ $index }})">
                                                        </p>
                                                    @endforeach
                                                </p>
                                            @endif
                                            @if ($file)
                                                <?php $this->emit('add-file'); ?>
                                            @endif
                                            @if ($files)
                                                <h4>Nuevos Archivos:</h4>
                                                <p>
                                                    @foreach ($files as $index => $file)
                                                        <p>
                                                            <img src="{{ asset('icons/file-earmark-arrow-up.svg') }}"
                                                                class="inline-flex" style="margin-right: 20px">
                                                            <spanclass="inline-flex"
                                                                style="margin-right: 30px">{{ $file->getClientOriginalName() }}</spanclass=>
                                                            <img class="inline-flex" src="{{ asset('icons/file-earmark-x.svg') }}"
                                                                wire:click="deleteFile({{ $index }} )">
                                                        </p>
                                                    @endforeach
                                                </p>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Button -->
                                    <p class="text-end">
                                        <button type="submit" id="singlebutton" name="singlebutton"
                                            class="btn btn-primary">Cargar Archivos</button>
                                        @if ($filesUploaded)
                                            <button type="button" wire:click="$emit('cargaCompleta')"
                                                class="btn btn-primary">Carga Completa</button>
                                        @endif
                                    </p>

                                    <p class="text-center">
                                        <a href="{{ url('/') }}" class="btn btn-primary">Regresar</a>
                                    </p>


                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

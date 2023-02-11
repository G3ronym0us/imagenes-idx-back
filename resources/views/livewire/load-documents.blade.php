<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card">
            <div class="card-header">
                <h3 class="text-center">Subir archivos de resultados</h2>
            </div>
            <div class="card-body">
                {{-- <div class="alert alert-danger">
                    <p class="text-center">{{session('errorconsulta')}}</p>
                </div> --}}
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
                                        <button type="button" wire:click="$emit('consultar')" class="btn btn-primary">Consultar</button>
                                    </p>
                                    <!-- Text input-->
                                    <div class="">
                                        <div class="mb-3">
                                            <label for="archivos">Archivos</label>
                                            <input wire:model="files" type="file" multiple
                                                class="form-control input-md">
                                            @error('files')
                                                <span class="text-danger"> {{ $message }} </span>
                                            @enderror
                                        </div>
                                        <div>
                                            @if ($filesUploaded)
                                                <h4>Archivos Cargados:</h4>
                                                <ul>
                                                    @foreach ($filesUploaded as $file)
                                                        <li>{{ $file->name }}</li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                            @if ($files)
                                                <h4>Nuevos Archivos:</h4>
                                                <ul>
                                                    @foreach ($files as $file)
                                                        <li>{{ $file->getClientOriginalName() }}</li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Button -->
                                    <p class="text-end">
                                        <button type="submit" id="singlebutton" name="singlebutton"
                                            class="btn btn-primary">Cargar Archivos</button>
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

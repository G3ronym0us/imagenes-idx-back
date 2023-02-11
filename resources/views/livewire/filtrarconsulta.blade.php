<div class="row justify-content-center align-items-center">
    <div class="col-md-6">
        <div class="col-md-12">
            <form wire:submit.prevent='filtrarconsultas' class="need-validation">
                <div class="row">
                    <div class="col col-md-8">
                        <input  wire:model='documento' type="text" class="form-control" placeholder="Numero de Documento" :value="old('documento')">
                        @error('documento')
                            <span class="text-danger"> {{$message}} </span>
                        @enderror
                    </div>
                    <div class="col col-md-4">
                        <button type="submit" id="singlebutton" name="singlebutton" class="btn btn-primary">Consultar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


 
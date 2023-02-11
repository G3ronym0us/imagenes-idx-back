<x-layout>
  
  <br><br>
<div class="row">
  <div class="col-md-6 offset-md-3">
    <div class="card">
      <div class="card-header">
        <h3 class="text-center">Creación de tickets</h2>
      </div>
      <div class="card-body">
        <div class="row justify-content-center align-items-center">
     
            <div class="col-md-12">
              <form class="form" method="POST" action="{{ route('ticket.nuevo_ticket') }}" >
                @csrf
                <fieldset>
                  <!-- Form Name -->
                  <p class="text-start">Por favor, para crear su ticket por favor ingrese la siguiente información:</p>
                  <!-- Text input-->
                  <div class="">
                    <div class="mb-3">                     
                      <input id="Numero de documento" name="documento" type="text" placeholder="Numero de Documento" class="form-control input-md"  value="{{old('documento')}}">
                      @error('documento')
                          <span class="text-danger"> {{$message}} </span>
                      @enderror
                    </div>
                  </div>
                  <br>
                  <!-- Text input-->
                  <div class="">
                    <div class="mb-3">
                      <input id="codigo" name="codigo" type="text" placeholder="Codigo" class="form-control input-md" value="{{old('codigo')}}">
                      @error('codigo')
                          <span class="text-danger"> {{$message}} </span>
                      @enderror
                    </div>
                  </div>
                  
                  <!-- Button -->
                 
                  <p class="text-end"><button type="submit" id="singlebutton" name="singlebutton" class="btn btn-primary">Guardar datos y Crear ticket</button></p>
                  <p class="text-center">
                    <a href="{{url('/')}}" class="btn btn-primary">Regresar</a>
                  </p>
                      
                    
              
                </fieldset>
              </form>
            </div>
       
        </div>
      </div>
    </div>
  </div>
</div>
    
</x-layout>
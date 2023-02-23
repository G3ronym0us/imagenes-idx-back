<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Asignar Cita
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Asignar Cita</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent='assignDate' class="need-validation">
                    <div class="form-group">
                        <label for="">Documento</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="form-group text-center mt-4">
                        <button class="btn btn-primary btn-sm">Asignar Cita</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

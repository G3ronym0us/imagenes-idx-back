<div>
    @if (session()->has('errorconsulta'))
        <div class="alert alert-danger">
            <p class="text-center">{{ session('errorconsulta') }}</p>
        </div>
    @endif
    <livewire:patient.register />
    <livewire:filtrarconsulta />

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Orden de Servicio</th>
                <th>Fecha</th>
                <th>Status</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($tickets as $data)
                <tr>
                    <td>{{ $data->codigo }}</td>
                    <td>{{ $data->created_at }}</td>
                    <td>{{ $data->status->firstWhere('pivot.created_at', $data->status->max('pivot.created_at'))->name }}
                    </td>
                    <td>
                        <button class="btn btn-primary" wire:click="selectTicket({{ $data->id }})">Ver</button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">Consulte su ticket</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <p class="text-center">
        <a href="{{ url('/') }}" class="btn btn-primary">Regresar</a>
    </p>
</div>


<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Documento:
                @if ($currentTicket)
                     {{ $currentTicket->documento }}
                @endif
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

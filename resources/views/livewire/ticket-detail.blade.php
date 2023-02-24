<div class="row pt-5">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header">
                <h3 class="text-center">Detalles de Tickets</h2>
            </div>
            <div class="card-body">
                <div class="row justify-content-center align-items-center">

                    <div class="col-md-12">
                        <div>
                            <p>Documento: {{ $ticket->documento }}</p>
                            <p>Orden de Servicio: {{ $ticket->codigo }}</p>
                        </div>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Status</th>
                                    <th>Usuario</th>
                                    <th>Fecha</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($ticket->status as $data)
                                    <tr>
                                        <td>{{ $data->name }}</td>
                                        <td>{{ $data->user->email }}</td>
                                        <td>{{ $data->pivot->updated_at }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center">Consulte su ticket</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <p class="text-center">
                            @if($nextStatus)
                                <button type="button" class="btn btn-primary" wire:click="changeStatus({{$nextStatus->id}})">{{ $nextStatus->name }}</button>
                            @endif
                            @if($firstStatus)
                                <button type="button" class="btn btn-primary" wire:click="reassignStatus()">Reasignar Cita</button>
                            @endif
                            @if($transcription == null && $transcriptionStatus)
                                <button type="button" class="btn btn-primary" wire:click="changeStatus({{ $transcriptionStatus->id }})">{{ $transcriptionStatus->visible_name }}</button>
                            @endif
                            @if($load == null && $loadStatus)
                                <button type="button" class="btn btn-primary" wire:click="changeStatus({{ $loadStatus->id }})">{{ $loadStatus->name }}</button>
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

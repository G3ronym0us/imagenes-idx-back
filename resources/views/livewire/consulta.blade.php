<div>
    @if(session()->has('errorconsulta'))
        <div class="alert alert-danger">
            <p class="text-center">{{session('errorconsulta')}}</p>
        </div>
    @endif

    <livewire:filtrarconsulta />

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Orden de Servicio</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($tickets as $data)
                <tr>
                    <td>{{$data->codigo}}</td>
                    <td>{{$data->created_at}}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">Consulte su ticket</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <p class="text-center">
        <a href="{{url('/')}}" class="btn btn-primary">Regresar</a>
    </p>
</div>

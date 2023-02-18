<x-app-layout>
    <div class="container" style="padding-top: 30px;">
        <div class="row">
            <div class="col-md-12">
                <h1>Bienvenidos Imágenes Diagnósticas IDX</h1>
                <p>Con esta herramienta podras realizar la creación de tickets y a su vez tambien podras
                    subir los documentos de las consultas de forma masiva.
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <img src="{{ asset('descarga.jpeg') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Generar Tickets</h5>
                        <p class="card-text">Genere el ticket con la información de consulta de resultados para el
                            cliente.</p>
                        <a href="{{ route('ticket.new') }}" class="btn btn-primary">Generar ahora!</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTrU9OxUToi6tQGIN9d8k0YVDJyHUzoaWrAIg&usqp=CAU"
                        class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Consultar Tickets</h5>
                        <p class="card-text">Consulte los tickets generados del cliente para nombrar sus archivos antes
                            de cargarlos.</p>
                        <a href="{{ route('ticket.consulta') }}" class="btn btn-primary">Consultar ahora!</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="http://aupe.org.uy/web/wp-content/uploads/2013/08/Curso-2-2013-opcion-grande.jpg"
                        class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Cargar Documentos</h5>
                        <p class="card-text">Cargue de forma masiva los documentos de los resultados de examenes de sus
                            clientes.</p>
                        <a href="{{ route('documents.index') }}" class="btn btn-primary">Cargar ahora!</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

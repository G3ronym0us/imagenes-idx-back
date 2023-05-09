<?php

namespace App\Http\Livewire;

use App\Http\Services\FileServerService;
use App\Models\Document;
use App\Models\Ticket;
use App\Http\Traits\ManagerFileS3;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Validator;
use Livewire\Component;
use Livewire\WithFileUploads;

class LoadDocuments extends Component
{
    use WithFileUploads, ManagerFileS3;

    public $file;
    public $files = [];
    public $documentNumber;
    public $code;
    public $filesUploaded;

    protected $rules = [
        'documentNumber' => 'required|integer',
        'code' => 'required|alpha_num|max:255',
        'files' => 'required|mimes:pdf|max:124000',
        'files' => 'required',
    ];

    protected $messages =  [
        'files.required' => 'El o los Archivos son necesarios!!',
        'documentNumber.required' => 'El Numero de Documento no puede estar vacio!!',
        'documentNumber.integer' => 'El Numero de Documento debe ser solo numeros!!',
        'code.required' => 'El Codigo no puede estar vacio!!',
        'code.alpha_num' => 'El Codigo debe ser solo alfanumerico!!',
    ];

    protected $listeners = [
        'consultar'     => 'consultarDocumentos',
        'cargaCompleta' => 'cargaCompleted',
        'add-file'     => 'addFile'
    ];

    public function addFile()
    {
        if (!is_array($this->file)) return;
        foreach ($this->file as $file) {
            array_push($this->files, $file);
        }
        $this->file = null;
    }

    public function save()
    {

        $this->validate();

        $ticket = Ticket::where('documento', $this->documentNumber)->where('codigo', $this->code)->first();
        if ($ticket) {

            try {
                foreach ($this->files as $index => $file) {
                    $url[] = [
                        "url[{$index}]",
                        $file->getRealPath(),
                        $file->getClientOriginalName()
                    ];
                }
                $fileServer = new FileServerService();
                $request = Http::withHeaders([
                    'Authorization' => $fileServer->token,
                ]);
                foreach ($this->files as $index => $file) {
                    $uploadedFile = new UploadedFile(
                        $file->getRealPath(), // Ruta real del archivo
                        $file->getClientOriginalName(), // Nombre original del archivo
                        $file->getClientMimeType(), // Tipo de MIME del archivo
                        null, // Tamaño del archivo (en bytes) - se dejará a cargo de Laravel
                        true // true si se quiere guardar el archivo temporalmente en el disco local, false en caso contrario
                    );
                    $request->attach(
                        "url[{$index}]",
                        file_get_contents($uploadedFile),
                        $file->getClientOriginalName(),
                        [
                            'Content-Type' => $file->getClientMimeType()
                        ]
                    );
                }
                $response = $request->post('http://181.143.216.68/api/files', [
                    'client' => $this->documentNumber,
                ]);
                $responseObject = $response->object();
                foreach ($responseObject->data as $key => $file) {
                    Document::create([
                        'numeroDocumento'   => $this->documentNumber,
                        'codigo'            => $this->code,
                        'ruta'              => $file->url,
                        'name'              => $file->fileName
                    ]);
                }
                $this->files = [];
                $this->filesUploaded = Document::where('numeroDocumento', $this->documentNumber)->where('codigo', $this->code)->get();
                $this->addError('mensaje', 'El o los archivos han sido subido con exito!');
            } catch (\Exception $e) {
                dd($e->getMessage());
            }
        } else {
            $this->addError('error', 'El Documento y Codigo no coinciden!');
        }
    }

    public function consultarDocumentos()
    {
        $ticket = Ticket::where('documento', $this->documentNumber)->where('codigo', $this->code)->first();
        if ($ticket) {
            $documents = Document::where('numeroDocumento', $this->documentNumber)->where('codigo', $this->code)->get();
            if ($documents && count($documents) > 0) {
                $this->filesUploaded = $documents;
            } else {
                $this->addError('error', 'El ticket no tiene documentos cargados!');
            }
        } else {
            $this->addError('error', 'El Documento y Codigo no coinciden!');
        }
    }

    public function cargaCompleted()
    {
        $this->addError('mensaje', 'Los documentos del ticket han sido cargados completamente!');
    }

    public function render()
    {
        return view(
            'livewire.load-documents',
            ['files' => $this->files, 'documentNumber' => $this->documentNumber, 'code' => $this->code]
        );
    }

    public function deleteFile($index)
    {
        array_splice($this->files, $index, 1);
    }

    public function deleteFileUploaded($id, $index)
    {
        $document = Document::find($id);
        $this->DeleteFileS3($document);
        $document->delete();
        $this->filesUploaded = Document::where('numeroDocumento', $this->documentNumber)->where('codigo', $this->code)->get();
    }
}

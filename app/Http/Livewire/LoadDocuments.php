<?php

namespace App\Http\Livewire;

use App\Models\Document;
use App\Models\Ticket;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Validator;
use Livewire\Component;
use Livewire\WithFileUploads;

class LoadDocuments extends Component
{
    use WithFileUploads;

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
        if(!is_array($this->file)) return;
        foreach($this->file as $file){
            array_push($this->files, $file);
        }
        $this->file = null;
    }

    public function save()
    {

        $this->validate();

        $ticket = Ticket::where('documento', $this->documentNumber)->where('codigo', $this->code)->first();
        if ($ticket) {
            foreach ($this->files as $file) {
                $url = $file->storeAs('documents');
                Document::create([
                    'numeroDocumento'   => $this->documentNumber,
                    'codigo'            => $this->code,
                    'ruta'              => $url,
                    'name'              => $file->getClientOriginalName()
                ]);
            }
            $this->files = [];
            $this->filesUploaded = Document::where('numeroDocumento', $this->documentNumber)->where('codigo', $this->code)->get();
            $this->addError('mensaje', 'El o los archivos han sido subido con exito!');
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

    public function deleteFile($index){
        array_splice($this->files, $index, 1);
    }

    public function deleteFileUploaded($id, $index){
        $document = Document::find($id);
        Storage::delete($document->ruta);
        $document->delete();
        $this->filesUploaded = Document::where('numeroDocumento', $this->documentNumber)->where('codigo', $this->code)->get();
    }

}

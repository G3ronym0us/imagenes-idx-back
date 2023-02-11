<?php

namespace App\Http\Livewire;

use App\Models\Document;
use App\Models\Ticket;
use Livewire\Component;

class DownloadDocuments extends Component
{

    public $documentNumber;
    public $code;

    protected $rules = [
        'documentNumber' => 'required|integer',
        'code' => 'required|alpha_num|max:255',
    ];

    protected $messages =  [
        'documentNumber.required' => 'El Numero de Documento no puede estar vacio!!',
        'documentNumber.integer' => 'El Numero de Documento debe ser solo numeros!!',
        'code.required' => 'El Codigo no puede estar vacio!!',
        'code.alpha_num' => 'El Codigo debe ser solo alfanumerico!!',
    ];

    public function render()
    {
        return view('livewire.download-documents');
    }

    public function save()
    {

        $this->validate();

        $ticket = Ticket::where('documento', $this->documentNumber)->where('codigo', $this->code)->first();
        if ($ticket) {

            $files = Document::where('numeroDocumento', $this->documentNumber)->where('codigo', $this->code)->get();


            $zip_file = "results-{$ticket->documento}-{$ticket->codigo}.zip";
            $zip = new \ZipArchive();
            $zip->open($zip_file, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);

            foreach ($files as $file) {
                $path = storage_path("app/{$file->ruta}");
                $zip->addFile($path, $file->ruta);
            }

            $zip->close();
            return response()->download($zip_file);
        } else {
            $this->addError('error', 'El Documento y Codigo no coinciden!');
        }
    }
}

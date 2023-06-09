<?php

namespace App\Http\Livewire;

use App\Http\Services\FileServerService;
use App\Models\Document;
use App\Models\Ticket;
use App\Http\Traits\ManagerFileS3;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class DownloadDocuments extends Component
{
    use ManagerFileS3;

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
        $documents = Document::where('numeroDocumento', $this->documentNumber)->where('codigo', $this->code)->get();
        foreach ($documents as $key => $document) {
            $documentArray[] = [
                "url"   => $document->ruta,
                "name"  => $document->name
            ];
        }
        if ($ticket) {

            try {
                $fileServer = new FileServerService();
                $response = Http::withHeaders([
                    'Authorization' => $fileServer->token,
                ])->post('http://181.143.216.68/api/files/download', [
                    "ticketNumber" => 12345,
                    "ticketCode" => 12345,
                    "url" => $documentArray
                ]);
                return response()->streamDownload(function () use ($response) {
                    echo $response->getBody();
                }, 'archivo.zip');
            } catch (\Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException $exception) {
                dd($exception);
            }

            // $files = Document::where('numeroDocumento', $this->documentNumber)->where('codigo', $this->code)->get();

            // if (count($files) > 0) {
            //     $zip_file = "results-{$ticket->documento}-{$ticket->codigo}.zip";
            //     $zip = new \ZipArchive();
            //     $zip->open($zip_file, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);

            //     foreach ($files as $file) {
            //         $path = $this->GetPathS3($file);
            //         $zip->addFromString($file->name, $path);
            //     }

            //     $zip->close();
            //     return response()->download($zip_file);
            // }else{
            //     $this->addError('error', 'Este ticket no tiene documentos!');
            // }
        } else {
            $this->addError('error', 'El Documento y Codigo no coinciden!');
        }
    }
}

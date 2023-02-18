<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Models\Document;
use App\Models\Ticket;
use App\Models\Archivo;

class DocumentController extends Controller
{
    /**
     * Display a liting of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('documents.index');
    }

    public function results()
    {
        return view('documents.results');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'documento'=>'required|integer',
            'codigo'=>'required|alpha_num|max:255',
            'archivos'=>'required|mimes:pdf|max:124000',
            'archivos'=>'required',
        ],
        [
            'archivos.required'=>'El o los Archivos son necesarios!!',
            'documento.required'=>'El Numero de Documento no puede estar vacio!!',
            'documento.integer'=>'El Numero de Documento debe ser solo numeros!!',
            'codigo.required'=>'El Codigo no puede estar vacio!!',
            'codigo.alpha_num'=>'El Codigo debe ser solo alfanumerico!!',
        ]);

        //$conteofile = is_array($request->file('archivos')) ? count($request->file('archivos')) : 0;
        //if ( $request->hasFile('archivos') || $conteofile > 1 )
        if ( $request->hasFile('archivos') )
        {
            $arrayaux = null;

            $documentos = new Document;

            foreach ($request->file('archivos') as $key => $archivo)
            {
                $documentos->numeroDocumento = $request->documento;
                $documentos->codigo = $request->codigo;

                /* $hora_actual = date('h:i:s');
                $hora = date('h:i:s',strtotime($hora_actual."+ $i second")); */

                $ruta = Storage::putFileAs(
                    "public",
                    $archivo,
                    //$documentos->numeroDocumento."-".$documentos->numeroArchivo."-".$hora.".".$request->file()[$i]->extension()
                    //$documentos->numeroDocumento."-".$documentos->numeroArchivo.".".$archivo->extension()
                    $archivo->getClientOriginalName()
                );

                $documentos->ruta = "https://backidx.olah.agency/storage/app/public/".$archivo->getClientOriginalName();

                $bandera = $documentos->save();
                unset($docfile);
            }


            if ($bandera) {
                return back()->with('mensaje','Archivos subidos con exito!!');
            }

        }else{
            return back()->with('error','No ha seleccionado ningún archivo!!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

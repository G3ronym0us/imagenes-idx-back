<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Validator;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("tickets.new");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validator::make(
            $request->all(),
            [
                'documento' => 'required|integer',
                'codigo' => 'required|alpha_num|max:255',
            ],
            [
                'documento.required' => 'El Numero de Documento no puede estar vacio!!',
                'documento.integer' => 'El Numero de Documento debe ser solo numeros!!',
                'codigo.required' => 'El Codigo no puede estar vacio!!',
                'codigo.alpha_num' => 'El Codigo debe ser solo alfanumerico!!',
            ]
        );


        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 8; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        $ticket = new Ticket();
        $ticket->documento = $request->input("documento");
        $ticket->codigo = $request->input("codigo");
        $ticket->orden_de_servicio = $randomString;
        $ticket->save();

        return redirect()->route('ticket.show', [
            'ticket' => $ticket,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        $pdf = Pdf::loadView('tickets.ticket_new', [
            'ticket' => $ticket
        ])->setPaper(array(0, 0, 170, 170), 'portrait');

        return $pdf->download($ticket->orden_de_servicio . ".pdf");
    }

    public function consulta()
    {
        return view('tickets.consulta');
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

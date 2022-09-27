<?php

namespace App\Http\Controllers;

use App\Services\Ticket\TicketService;
use App\Services\User\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class TicketController extends Controller
{
    protected $service;
    protected $userService;

    public function __construct(TicketService $service, UserService $userService)
    {
        $this->service = $service;
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tickets = $this->service->getTickets();

        return view('tickets.index')
            ->with([
                'tickets' => $tickets
            ]);
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
        //
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
        $ticket = $this->service->getTicketById($id);

        $developers = $this->userService->getDevelopers();

        return view('tickets.edit')
            ->with([
                'ticket' => $ticket,
                'developers' => $developers
            ]);
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
        $ticket = $this->service->getTicketById($id);

        $data = $request->validate($this->service->updateRules($ticket));

        \DB::beginTransaction();
        try {
            $this->service->updateTicket($id, Arr::except($data, 'developers'));

            if(!empty($data['developers'])) {
                $ticket->developers()->sync($data['developers']);
            }

            \DB::commit();

            return redirect()->route('tickets.index');

        } catch (\Exception $e) {
            \DB::rollback();
            dd($e);
            \Log::info('ticket update error:'. $e->getMessage());

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ticket = $this->service->getTicketById($id);

        $ticket->developers()->detach();

        $this->service->deleteTicket($id);

        return redirect()->route('tickets.index');
    }
}

<?php

namespace App\Http\Controllers;

use App\Services\Ticket\TicketService;
use App\Services\User\UserService;
use Illuminate\Http\Request;

class TicketBoxController extends Controller
{
    protected $service;

    public function __construct(TicketService $service, UserService $userService)
    {
        $this->service = $service;
        $this->userService = $userService;
    }

    public function index()
    {
        return view('welcome');
    }

    public function store(Request $request)
    {
        $data = $request->validate($this->service->insertRules());

        $this->service->insertTicket($data);

        return redirect()->route('ticket.box');
    }
}

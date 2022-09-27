<?php

namespace App\Services\Ticket;

use App\Repositories\Ticket\TicketRepositoryInterface;

class TicketService
{
    protected $ticketRepository;

    protected $limit = 10;

    protected $offset = 0;

    public function __construct(TicketRepositoryInterface $ticketRepository)
    {
        $this->ticketRepository = $ticketRepository;
    }

    public function getTickets()
    {
        return $this->ticketRepository->getTickets();
    }

    public function getTicketById($id)
    {
        return $this->ticketRepository->getTicketById($id);
    }

    public function insertTicket($data)
    {
        return $this->ticketRepository->insertTicket($data);
    }

    public function updateTicket($id, $data)
    {
        return $this->ticketRepository->updateTicket($id, $data);
    }

    public function deleteTicket($id)
    {
        return $this->ticketRepository->deleteTicket($id);
    }

    public function insertRules()
    {
        return [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'type' => 'required|string|max:255',
            'status' => 'required|string|max:255',
        ];
    }

    public function updateRules($ticket)
    {
        return [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'type' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'developers' => 'nullable|array',
        ];
    }
}

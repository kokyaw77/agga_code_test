<?php

namespace App\Repositories\Ticket;

interface TicketRepositoryInterface
{
    public function getTickets();

    public function getTicketById($id);

    public function insertTicket($data);

    public function updateTicket($id, $data);

    public function deleteTicket($id);
}

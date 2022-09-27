<?php

namespace App\Repositories\Ticket;

use App\Models\Ticket;

class TicketRepository implements TicketRepositoryInterface
{
    public function getTickets()
    {
         return $this->connection()->with('developers')->get();
    }


    public function getTicketById($id)
    {
        return $this->connection()->with('developers')->where('id', $id)->first();
    }

    public function insertTicket($data)
    {
        return $this->connection()->create($data);
    }

    public function updateTicket($id, $data)
    {
        return $this->connection()->where('id', $id)->update($data);
    }

    public function deleteTicket($id)
    {
        return $this->connection()->where('id', $id)->delete();
    }

    public function connection()
    {
        return new Ticket();
    }
}

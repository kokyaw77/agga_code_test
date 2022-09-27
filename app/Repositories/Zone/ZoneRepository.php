<?php

namespace App\Repositories\Zone;

use App\Models\Zone;

class ZoneRepository implements ZoneRepositoryInterface
{
    public function getZones($options)
    {
        $query = $this->connection()->query();

        if(isset($options['search'])) {
            $query = $query->where('name', 'LIKE', '%'. $options['search'] .'%')
                ->orwhere('name_mm', 'LIKE', '%'. $options['search'] .'%')
                ->orWhereHas('city', function($qr) use ($options) {
                    $qr->where('name', 'LIKE', '%'. $options['search'] .'%')
                        ->orWhere('name_mm', 'LIKE', '%'. $options['search'] .'%');
                });
        }

        return $query->limit($options['limit'])
            ->offset($options['offset'])
            ->get();

    }

    public function getZonesWithMetaData($options)
    {
        $query = $this->connection()->query();

        $total_count = $query->count();

        if(isset($options['search'])) {
            $query = $query->where('name', 'LIKE', '%'. $options['search'] .'%')
                ->orwhere('name_mm', 'LIKE', '%'. $options['search'] .'%')
                ->orWhereHas('city', function($qr) use ($options) {
                    $qr->where('name', 'LIKE', '%'. $options['search'] .'%')
                        ->orWhere('name_mm', 'LIKE', '%'. $options['search'] .'%');
                });;
        }

        $count = $query->count();

        $zones = $query->limit($options['limit'])
            ->offset($options['offset'])
            ->get();

        return [
            'meta' => [
                'count' => $count,
                'total_count' => $total_count
            ],
            'data' => $zones
        ];
    }


    public function getZoneById($id)
    {
        return $this->connection()->where('id', $id)->first();
    }

    public function insertZone($data)
    {
        return $this->connection()->create($data);
    }

    public function updateZone($id, $data)
    {
        return $this->connection()->where('id', $id)->update($data);
    }

    public function deleteZone($id)
    {
        return $this->connection()->where('id', $id)->delete();
    }

    public function connection()
    {
        return new Zone();
    }
}

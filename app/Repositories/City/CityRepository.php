<?php

namespace App\Repositories\City;

use App\Models\City;

class CityRepository implements CityRepositoryInterface
{
    public function getCities($options)
    {
        $query = $this->connection()->query();

        if(isset($options['search'])) {
            $query = $query->where('name', 'LIKE', '%'. $options['search'] .'%')
                ->orwhere('name_mm', 'LIKE', '%'. $options['search'] .'%');
        }

        return $query->limit($options['limit'])
            ->offset($options['offset'])
            ->get();

    }

    public function getCitiesWithMetaData($options)
    {
        $query = $this->connection()->query();

        $total_count = $query->count();

        if(isset($options['search'])) {
            $query = $query->where('name', 'LIKE', '%'. $options['search'] .'%')
                ->orwhere('name_mm', 'LIKE', '%'. $options['search'] .'%');
        }

        $count = $query->count();

        $cities = $query->limit($options['limit'])
            ->offset($options['offset'])
            ->get();

        return [
            'meta' => [
                'count' => $count,
                'total_count' => $total_count
            ],
            'data' => $cities
        ];
    }


    public function getCityById($id)
    {
        return $this->connection()->where('id', $id)->first();
    }

    public function insertCity($data)
    {
        return $this->connection()->create($data);
    }

    public function updateCity($id, $data)
    {
        return $this->connection()->where('id', $id)->update($data);
    }

    public function deleteCity($id)
    {
        return $this->connection()->where('id', $id)->delete();
    }

    public function connection()
    {
        return new City();
    }
}

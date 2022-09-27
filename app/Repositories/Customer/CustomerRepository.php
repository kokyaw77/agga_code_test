<?php

namespace App\Repositories\Customer;

use App\Models\Customer;

class CustomerRepository implements CustomerRepositoryInterface
{
    public function getCustomers($options)
    {
        $query = $this->connection()->query();

        if(isset($options['search'])) {
            $query = $query->where('name', 'LIKE', '%'. $options['search'] .'%')
                        ->orwhere('phone_no', 'LIKE', '%'. $options['search'] .'%')
                        ->orWhereHas('city', function($qr) use ($options) {
                            $qr->where('name', 'LIKE', '%'. $options['search'] .'%')
                                ->orWhere('name_mm', 'LIKE', '%'. $options['search'] .'%');
                        })
                        ->orWhereHas('zone', function($qr) use ($options) {
                            $qr->where('name', 'LIKE', '%'. $options['search'] .'%')
                                ->orWhere('name_mm', 'LIKE', '%'. $options['search'] .'%');
                        });
        }

        return $query->limit($options['limit'])
            ->offset($options['offset'])
            ->get();

    }

    public function getCustomersWithMetaData($options)
    {
        $query = $this->connection()->query();

        $total_count = $query->count();

        if(isset($options['search'])) {
            $query = $query->where('name', 'LIKE', '%'. $options['search'] .'%')
                        ->orwhere('phone_no', 'LIKE', '%'. $options['search'] .'%')
                        ->orWhereHas('city', function($qr) use ($options) {
                            $qr->where('name', 'LIKE', '%'. $options['search'] .'%')
                                ->orWhere('name_mm', 'LIKE', '%'. $options['search'] .'%');
                        })
                        ->orWhereHas('zone', function($qr) use ($options) {
                            $qr->where('name', 'LIKE', '%'. $options['search'] .'%')
                                ->orWhere('name_mm', 'LIKE', '%'. $options['search'] .'%');
                        });
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


    public function getCustomerById($id)
    {
        return $this->connection()->where('id', $id)->first();
    }

    public function insertCustomer($data)
    {
        return $this->connection()->create($data);
    }

    public function updateCustomer($id, $data)
    {
        return $this->connection()->where('id', $id)->update($data);
    }

    public function deleteCustomer($id)
    {
        return $this->connection()->where('id', $id)->delete();
    }

    public function connection()
    {
        return new Customer();
    }
}

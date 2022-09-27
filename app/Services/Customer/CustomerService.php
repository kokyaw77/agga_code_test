<?php

namespace App\Services\Customer;

use App\Repositories\Customer\CustomerRepositoryInterface;

class CustomerService
{
    protected $customerRepository;

    protected $limit = 10;

    protected $offset = 0;

    public function __construct(CustomerRepositoryInterface $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function getCustomers($request)
    {
        $options = $this->requestParams($request);

        return $this->customerRepository->getCustomers($options);
    }

    public function getCustomersWithMetaData($request)
    {
        $options = $this->requestParams($request);

        return $this->customerRepository->getCustomersWithMetaData($options);
    }

    public function getCustomerById($id)
    {
        return $this->customerRepository->getCustomerById($id);
    }

    public function insertCustomer($data)
    {
        return $this->customerRepository->insertCustomer($data);
    }

    public function updateCustomer($id, $data)
    {
        return $this->customerRepository->updateCustomer($id, $data);
    }

    public function deleteCustomer($id)
    {
        return $this->customerRepository->deleteCustomer($id);
    }

    public function requestParams($request)
    {
        return [
            'limit' => $request->get('limit') ?? $this->limit,
            'offset' => $request->get('offset') ?? $this->offset,
            'search' => $request->get('search') ?? null
        ];
    }

    public function insertRules()
    {
        return [
            'name' => 'required|string|max:255',
            'phone_no' => 'required|max:30|unique:customers,phone_no',
            'city_id' => 'required|exists:cities,id',
            'zone_id' => 'required|exists:zones,id',
            'address' => 'required|string|max:255'
        ];
    }

    public function updateRules($customer)
    {
        return [
            'name' => 'required|string|max:255',
            'phone_no' => 'required|max:30|unique:customers,phone_no,'.$customer->id,
            'city_id' => 'required|exists:cities,id',
            'zone_id' => 'required|exists:zones,id',
            'address' => 'required|string|max:255'
        ];
    }
}

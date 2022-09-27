<?php

namespace App\Repositories\Customer;

interface CustomerRepositoryInterface
{
    public function getCustomers($options);

    public function getCustomersWithMetaData($options);

    public function getCustomerById($id);

    public function insertCustomer($data);

    public function updateCustomer($id, $data);

    public function deleteCustomer($id);
}

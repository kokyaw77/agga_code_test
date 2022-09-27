<?php

namespace App\Repositories\City;

interface CityRepositoryInterface
{
    public function getCities($options);

    public function getCitiesWithMetaData($options);

    public function getCityById($id);

    public function insertCity($data);

    public function updateCity($id, $data);

    public function deleteCity($id);
}

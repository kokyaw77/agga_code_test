<?php

namespace App\Services\City;

use App\Repositories\City\CityRepositoryInterface;

class CityService
{
    protected $cityRepository;

    protected $limit = 10;

    protected $offset = 0;

    public function __construct(CityRepositoryInterface $cityRepository)
    {
        $this->cityRepository = $cityRepository;
    }

    public function getCities($request)
    {
        $options = $this->requestParams($request);

        return $this->cityRepository->getCities($options);
    }

    public function getCitiesWithMetaData($request)
    {
        $options = $this->requestParams($request);

        return $this->cityRepository->getCitiesWithMetaData($options);
    }

    public function getCityById($id)
    {
        return $this->cityRepository->getCityById($id);
    }

    public function insertCity($data)
    {
        return $this->cityRepository->insertCity($data);
    }

    public function updateCity($id, $data)
    {
        return $this->cityRepository->updateCity($id, $data);
    }

    public function deleteCity($id)
    {
        return $this->cityRepository->deleteCity($id);
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
            'name' => 'required|string|max:255|unique:cities,name',
            'name_mm' => 'required|string|max:255|unique:cities,name_mm',
        ];
    }

    public function updateRules($city)
    {
        return [
            'name' => 'required|string|max:255|unique:cities,name',
            'name_mm' => 'required|string|max:255|unique:cities,name_mm,'.$city->id,
        ];
    }
}

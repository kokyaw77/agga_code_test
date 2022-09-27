<?php

namespace App\Services\Zone;

use App\Repositories\Zone\ZoneRepositoryInterface;

class ZoneService
{
    protected $zoneRepository;

    protected $limit = 10;

    protected $offset = 0;

    public function __construct(ZoneRepositoryInterface $zoneRepository)
    {
        $this->zoneRepository = $zoneRepository;
    }

    public function getZones($request)
    {
        $options = $this->requestParams($request);

        return $this->zoneRepository->getZones($options);
    }

    public function getZonesWithMetaData($request)
    {
        $options = $this->requestParams($request);

        return $this->zoneRepository->getZonesWithMetaData($options);
    }

    public function getZoneById($id)
    {
        return $this->zoneRepository->getZoneById($id);
    }

    public function insertZone($data)
    {
        return $this->zoneRepository->insertZone($data);
    }

    public function updateZone($id, $data)
    {
        return $this->zoneRepository->updateZone($id, $data);
    }

    public function deleteZone($id)
    {
        return $this->zoneRepository->deleteZone($id);
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
            'name' => 'required|string|max:255|unique:zones,name',
            'name_mm' => 'required|string|max:255|unique:zones,name_mm',
            'city_id' => 'required|exists:cities,id'
        ];
    }

    public function updateRules($zone)
    {
        return [
            'name' => 'required|string|max:255|unique:zones,name',
            'name_mm' => 'required|string|max:255|unique:zones,name_mm,'.$zone->id,
            'city_id' => 'required|exists:cities,id'
        ];
    }
}

<?php

namespace App\Repositories\Zone;

interface ZoneRepositoryInterface
{
    public function getZones($options);

    public function getZonesWithMetaData($options);

    public function getZoneById($id);

    public function insertZone($data);

    public function updateZone($id, $data);

    public function deleteZone($id);
}

<?php
namespace App\Services;

/**
 * Interface CRMInterface
 * @package App\Services
 */
interface CrmInterface
{
    /**
     * @param $id string
     * @return mixed
     */
    public function find(string $id);

    public function store();
}
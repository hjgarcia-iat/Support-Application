<?php
namespace App\Services;

/**
 * Interface CRMInterface
 * @package App\Services
 */
interface CRMInterface
{
    /**
     * @param $id string
     * @return mixed
     */
    public function find(string $id);

    public function store();
}
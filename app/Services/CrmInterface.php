<?php
namespace App\Services;

/**
 * Interface CRMInterface
 * @package App\Services
 */
interface CrmInterface
{
    /**
     * @param $email string
     * @return mixed
     */
    public function findByEmail(string $email);

    public function store();
}
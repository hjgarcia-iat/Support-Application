<?php

namespace App\Services;

use App\Mail\EmailLeadToRep;

/**
 * Class FakeCRM
 * @package App\Services
 */
class CrmFake implements CrmInterface
{
    /**
     * Temporary store for the FAKE Data
     *
     * @var array|string[]
     */
    protected array $data = ['A1' => []];

    public function findByEmail(string $email)
    {
        return $this->data['A1'];
    }

    public function store(): string
    {
        $this->data['A1']['first_name'] = request('first_name');
        $this->data['A1']['last_name'] = request('last_name');
        $this->data['A1']['email'] = request('email');
        $this->data['A1']['phone'] = request('phone');
        $this->data['A1']['role'] = request('role');
        $this->data['A1']['school'] = request('school');
        $this->data['A1']['city'] = request('city');
        $this->data['A1']['state'] = request('state');

        return 'A1';
    }

    /**
     * @inheritDoc
     */
    public function delete(string $email): bool
    {
        return true;
    }
}
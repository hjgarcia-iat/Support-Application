<?php

namespace App\Services;

/**
 * Class FakeCRM
 * @package App\Services
 */
class CrmFake implements CrmInterface
{
    /**
     * @var array|string[]
     */
    protected array $data = [];

    public function findByEmail(string $email)
    {
        return $this->data[$email];
    }

    public function store(array $data): string
    {
        foreach ($data as $key => $field) {
            $this->data[$data['email']][$key] = $field;
        }

        return $data['email'];
    }

    public function delete(string $email): bool
    {
        if (array_key_exists($email, $this->data)) {
            unset($this->data[$email]);
            return true;
        }

        return false;
    }
}
<?php

namespace App\Services;

use Omniphx\Forrest\Providers\Laravel\Facades\Forrest;

/**
 * Class CrmSalesforce
 * @package App\Services
 */
class CrmSalesforce implements CrmInterface
{
    public function __construct()
    {
        Forrest::authenticate();
    }

    /**
     * @param string $email
     * @return array|mixed
     */
    public function findByEmail(string $email)
    {
        $records = Forrest::query("SELECT Id,email,FirstName,LastName,Phone,Role__c,Company,City,State From Lead WHERE email='{$email}'")['records'];

        if (!empty($records)) return $records[0];

        return [];
    }

    public function store()
    {
        Forrest::sobjects('Lead', [
            'method' => 'post',
            'body'   => [
                'FirstName' => request('first_name'),
                'LastName'  => request('last_name'),
                'Email'     => request('email'),
                'Phone'     => request('phone'),
                'Role__c'   => request('role'),
                'Company'   => request('school'),
                'City'      => request('city'),
                'State'     => request('state'),
            ],
        ]);
    }

    public function delete(string $email): bool
    {
        $record = Forrest::query("SELECT Id,email,FirstName,LastName,Phone,Role__c,Company,City,State From Lead WHERE email='{$email}'")['records'];

        Forrest::sobjects('Lead/' . $record[0]['Id'], ['method' => 'delete']);

        return true;
    }
}
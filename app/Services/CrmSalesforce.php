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
        $records = Forrest::query("SELECT Id,email,FirstName,LastName,Phone,Role__c,Company,City,State,Description,Product_Interest__c,District_Name__c From Lead WHERE email='{$email}'")['records'];

        if (!empty($records)) return $records[0];

        return [];
    }

    public function store(array $data)
    {
        Forrest::sobjects('Lead', [
            'method' => 'post',
            'body'   => [
                'FirstName'           => $data['first_name'],
                'LastName'            => $data['last_name'],
                'Email'               => $data['email'],
                'Phone'               => $data['phone'],
                'Role__c'             => $data['role'],
                'Company'             => $data['school'],
                'District_Name__c'    => $data['district'],
                'City'                => $data['city'],
                'State'               => $data['state'],
                'Product_Interest__c' => $data['product_interest'],
                'Description'         => (isset($data['description']) ? 'Number of teachers: ' . $data['number_of_teachers'] . ' Number of students: ' . $data['number_of_teachers'] . ' Usage: ' . $data['usage'] : ''),
            ],
        ]);

        return $data['email'];
    }

    public function delete(string $email): bool
    {
        $record = Forrest::query("SELECT Id From Lead WHERE email='{$email}'")['records'];

        Forrest::sobjects('Lead/' . $record[0]['Id'], ['method' => 'delete']);

        return true;
    }
}
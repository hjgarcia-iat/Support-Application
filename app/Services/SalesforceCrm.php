<?php

namespace App\Services;

/**
 * Class SalesforceCrm
 * @package App\Services
 */
class SalesforceCrm implements CRMInterface
{
    public function find(string $id)
    {
        // TODO: Implement find() method.
    }

    public function store()
    {
        // TODO: Implement store() method.
    }


//    /**
//     * Create a salesforce lead based on conceptua demo request form
//     *
//     * @param $request
//     * @return bool|mixed
//     */
//    public function createConceptuaDemoRequestLead($request)
//    {
//        $sObject                             = new stdclass();
//        $sObject->FirstName                  = $request->get('first_name');
//        $sObject->LastName                   = $request->get('last_name');
//        $sObject->Email                      = $request->get('email');
//        $sObject->City                       = $request->get('city');
//        $sObject->State                      = $request->get('state');
//        $sObject->Company                    = $request->get('company');
//        $sObject->Title                      = $request->get('title');
//        $sObject->LeadSource                 = 'Web Lead';
//        $sObject->Additional_Lead_Sources__c = 'Conceptua Math Demo Request';
//
//        $sObject->Role__c                    = 'Classroom Teacher';
//        $sObject->Product_Interest__c        = 'Conceptua Math';
//        $sObject->License_Type_Interest__c   = 'Classroom';
//        $sObject->License_Type__c            = 'Conceptua Math';
//
//        $sObject->OwnerId                    = $this->setLeadOwner($request->get('state'));
//
//
//        if ($request->has('phone')) {
//            $sObject->Phone = $request->get('phone');
//        }
//
//        $lead = \Salesforce::create([$sObject], 'Lead');
//
//
//        $this->sendLeadEmailToRep($request, $lead[0]->id);
//
//        return true;
//    }
//
//    /**
//     * Create lead in salesforce based on Conceptua Quote Request Form
//     *
//     * @param $request
//     * @return mixed
//     */
//    public function createConceptuaQuoteRequestLead($request)
//    {
//
//        $sObject                                 = new stdclass();
//        $sObject->FirstName                      = $request->get('first_name');
//        $sObject->LastName                       = $request->get('last_name');
//        $sObject->Email                          = $request->get('email');
//        $sObject->Title                          = $request->get('title');
//        $sObject->License_Type_Interest__c       = $request->get('license');
//        $sObject->Company                        = $request->get('company');
//        $sObject->City                           = $request->get('city');
//        $sObject->State                          = $request->get('state');
//        $sObject->LeadSource                     = 'Web Lead';
//
//        $sObject->Role__c = 'Classroom Teacher';
//        $sObject->Product_Interest__c = 'Conceptua Math';
//        $sObject->License_Type_Interest__c = 'Classroom';
//        $sObject->License_Type__c = 'Conceptua Math';
//
//        $sObject->Additional_Lead_Sources__c     = 'Conceptua Math Quote Request';
//        $sObject->OwnerId                        = $this->setLeadOwner($request->get('state'));
//
//        if ($request->has('phone')) {
//            $sObject->Phone = $request->get('phone');
//        }
//
//        $lead = \Salesforce::create([$sObject], 'Lead');
//
//        $this->sendLeadEmailToRep($request, $lead[0]->id);
//
//        return true;
//    }
//
//    /**
//     * @param $request
//     * @return mixed
//     */
//    public function createContactFormLead($request)
//    {
//        $territory = $territory = Territory::whereZipCode($request->get('zip'))->first();
//
//        $sObject                   = new stdclass();
//        $sObject->FirstName        = $request->get('first_name');
//        $sObject->LastName         = $request->get('last_name');
//        $sObject->Email            = $request->get('email');
//        $sObject->City             = $territory->city;
//        $sObject->State            = $territory->state_prefix;
//        $sObject->PostalCode       = $territory->zip_code;
//        $sObject->District_Name__c = $request->get('district');
//        $sObject->Company          = $request->get('school');
//        $sObject->Description      = $request->get('comment');
//        $sObject->LeadSource       = 'Web Lead';
//        $sObject->OwnerId          = $this->setLeadOwner($territory->state_prefix);
//
//        $lead                      = \Salesforce::create([$sObject], 'Lead');
//
//
//        return $lead[0]->id;
//    }
//
//    /**
//     * @param $request
//     * @return mixed
//     */
//    public function createConceptuaCaseStudyLead($request)
//    {
//        $sObject                                 = new stdclass();
//        $sObject->FirstName                      = $request->get('first_name');
//        $sObject->LastName                       = $request->get('last_name');
//        $sObject->Email                          = $request->get('email');
//        $sObject->City                           = $request->get('city');
//        $sObject->State                          = $request->get('state');
//        $sObject->Company                        = $request->get('company');
//        $sObject->Title                          = $request->get('title');
//        $sObject->LeadSource                     = 'Web Lead';
//
//        $sObject->Role__c = 'Classroom Teacher';
//        $sObject->Product_Interest__c = 'Conceptua Math';
//        $sObject->License_Type_Interest__c = 'Classroom';
//        $sObject->License_Type__c = 'Conceptua Math';
//
//        $sObject->Additional_Lead_Sources__c     = 'Conceptua Math Case Study Request';
//        $sObject->OwnerId                        = $this->setLeadOwner($request->get('state'));
//
//        if ($request->has('phone')) {
//            $sObject->Phone = $request->get('phone');
//        }
//
//        $lead = \Salesforce::create([$sObject], 'Lead');
//
//        $this->sendLeadEmailToRep($request, $lead[0]->id);
//
//        return true;
//    }

//    /**
//     * Send email to rep
//     * @param $request
//     * @param $leadId
//     * @return mixed
//     */
//    public function sendLeadEmailToRep($request, $leadId)
//    {
//        \Mail::to($this->setLeadEmail($request))->send(new EmailLeadToRep($request, $leadId));
//    }

//    /**
//     * Set lead owner id
//     *
//     * @param $state
//     * @return string
//     */
//    private function setLeadOwner($state)
//    {
//        $states = [
//            'Canada' => '0051O00000CkEhQ',
//            'Other'  => '0051O00000CkEhQ',
//            'AL'     => '0051O00000CkEhQ',
//            'AK'     => '0051O00000CkEhQ',
//            'AZ'     => '0051O00000CkLZT',
//            'AR'     => '0051O00000CkEhQ',
//            'CA'     => '0051O00000CkLZT',
//            'CO'     => '0051O00000CkLZT',
//            'CT'     => '0051O00000CkEGe',
//            'DE'     => '0051O00000CkEhQ',
//            'DC'     => '0051O00000CkEhQ',
//            'FL'     => '0051O00000CkGQW',
//            'GA'     => '0051O00000CkGQW',
//            'HI'     => '0051O00000CkEhQ',
//            'ID'     => '0051O00000CkEhQ',
//            'IL'     => '0051O00000CkGQg',
//            'IN'     => '0051O00000CkEhQ',
//            'IA'     => '0051O00000CkGQg',
//            'KS'     => '0051O00000CkEhQ',
//            'KY'     => '0051O00000CkEhQ',
//            'LA'     => '0051O00000CkEhQ',
//            'ME'     => '0051O00000CkEhQ',
//            'MD'     => '0051O00000CkGQW',
//            'MA'     => '0051O00000CkEGe',
//            'MI'     => '0051O00000CkGQg',
//            'MN'     => '0051O00000CkGQg',
//            'MS'     => '0051O00000CkEhQ',
//            'MO'     => '0051O00000CkGQg',
//            'MT'     => '0051O00000CkEhQ',
//            'NE'     => '0051O00000CkEhQ',
//            'NV'     => '0051O00000CkLZT',
//            'NH'     => '0051O00000CkEGe',
//            'NJ'     => '0051O00000CkGQW',
//            'NM'     => '0051O00000CkLZT',
//            'NY'     => '0051O00000CkEGe',
//            'NC'     => '0051O00000CkEhQ',
//            'ND'     => '0051O00000CkEhQ',
//            'OH'     => '0051O00000CkGQW',
//            'OK'     => '0051O00000CkEhQ',
//            'OR'     => '0051O00000CkLZT',
//            'PA'     => '0051O00000CkGQW',
//            'RI'     => '0051O00000CkEGe',
//            'SC'     => '0051O00000CkEhQ',
//            'SD'     => '0051O00000CkEhQ',
//            'TN'     => '0051O00000CkEhQ',
//            'TX'     => '0051O00000CkLZT',
//            'UT'     => '0051O00000CkEhQ',
//            'VT'     => '0051O00000CkEGe',
//            'VA'     => '0051O00000CkGQW',
//            'WA'     => '0051O00000CkLZT',
//            'WV'     => '0051O00000CkEhQ',
//            'WI'     => '0051O00000CkGQg',
//            'WY'     => '0051O00000CkEhQ',
//        ];
//
//        return array_get($states, $state);
//    }


    /**
     * Set lead owner id
     *
     * @param $request
     * @return string
     */
    private function setLeadEmail($request)
    {
        $states = [
            'Canada' => 'tpence@activatelearning.com',
            'Other'  => 'tpence@activatelearning.com',
            'AL'     => 'tpence@activatelearning.com',
            'AK'     => 'tpence@activatelearning.com',
            'AZ'     => 'dtoberman@activatelearning.com',
            'AR'     => 'tpence@activatelearning.com',
            'CA'     => 'dtoberman@activatelearning.com',
            'CO'     => 'dtoberman@activatelearning.com',
            'CT'     => 'jdivito@activatelearning.com',
            'DE'     => 'tpence@activatelearning.com',
            'DC'     => 'tpence@activatelearning.com',
            'FL'     => 'rantinori@activatelearning.com',
            'GA'     => 'rantinori@activatelearning.com',
            'HI'     => 'tpence@activatelearning.com',
            'ID'     => 'tpence@activatelearning.com',
            'IL'     => 'cweller@activatelearning.com',
            'IN'     => 'tpence@activatelearning.com',
            'IA'     => 'cweller@activatelearning.com',
            'KS'     => 'tpence@activatelearning.com',
            'KY'     => 'tpence@activatelearning.com',
            'LA'     => 'tpence@activatelearning.com',
            'ME'     => 'tpence@activatelearning.com',
            'MD'     => 'rantinori@activatelearning.com',
            'MA'     => 'jdivito@activatelearning.com',
            'MI'     => 'cweller@activatelearning.com',
            'MN'     => 'cweller@activatelearning.com',
            'MS'     => 'tpence@activatelearning.com',
            'MO'     => 'cweller@activatelearning.com',
            'MT'     => 'tpence@activatelearning.com',
            'NE'     => 'tpence@activatelearning.com',
            'NV'     => 'dtoberman@activatelearning.com',
            'NH'     => 'jdivito@activatelearning.com',
            'NJ'     => 'rantinori@activatelearning.com',
            'NM'     => 'dtoberman@activatelearning.com',
            'NY'     => 'jdivito@activatelearning.com',
            'NC'     => 'tpence@activatelearning.com',
            'ND'     => 'tpence@activatelearning.com',
            'OH'     => 'rantinori@activatelearning.com',
            'OK'     => 'tpence@activatelearning.com',
            'OR'     => 'dtoberman@activatelearning.com',
            'PA'     => 'rantinori@activatelearning.com',
            'RI'     => 'jdivito@activatelearning.com',
            'SC'     => 'tpence@activatelearning.com',
            'SD'     => 'tpence@activatelearning.com',
            'TN'     => 'tpence@activatelearning.com',
            'TX'     => 'dtoberman@activatelearning.com',
            'UT'     => 'tpence@activatelearning.com',
            'VT'     => 'jdivito@activatelearning.com',
            'VA'     => 'rantinori@activatelearning.com',
            'WA'     => 'dtoberman@activatelearning.com',
            'WV'     => 'tpence@activatelearning.com',
            'WI'     => 'cweller@activatelearning.com',
            'WY'     => 'tpence@activatelearning.com',
        ];

        return array_get($states, $request->get('state'));
    }
}
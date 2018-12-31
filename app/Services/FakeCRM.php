<?php

namespace App\Services;

use App\Mail\EmailLeadToRep;

/**
 * Class FakeCRM
 * @package App\Services
 */
class FakeCRM implements CRMInterface
{
    /**
     * Fake create lead method
     *
     * @param $request
     * @return bool
     */
    public function createConceptuaDemoRequestLead($request)
    {
        return true;
    }

    /**
     * @param $request
     * @return mixed
     */
    public function createConceptuaQuoteRequestLead($request)
    {
        return true;
    }

    /**
     * Create contact form lead
     *
     * @param $request
     * @return mixed
     */
    public function createContactFormLead($request)
    {
        return 'some-fake-lead-id';
    }

    /**
     * @param $request
     * @return mixed
     */
    public function createConceptuaCaseStudyLead($request)
    {
        $this->sendLeadEmailToRep($request, 'some-lead-id');
        return true;
    }

    /**
     * @param $request
     * @param $leadId
     * @return mixed
     */
    public function sendLeadEmailToRep($request, $leadId)
    {
        \Mail::to('salesperson@email.com')->send(new EmailLeadToRep($request, $leadId));
    }
}
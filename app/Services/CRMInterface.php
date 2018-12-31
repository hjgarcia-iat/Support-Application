<?php
namespace App\Services;

/**
 * Interface CRMInterface
 * @package App\Services
 */
interface CRMInterface
{
    /**
     * @param $request
     * @return mixed
     */
    public function createConceptuaDemoRequestLead($request);

    /**
     * @param $request
     * @return mixed
     */
    public function createConceptuaQuoteRequestLead($request);

    /**
     * @param $request
     * @return mixed
     */
    public function createContactFormLead($request);

    /**
     * @param $request
     * @return mixed
     */
    public function createConceptuaCaseStudyLead($request);

    /**
     * @param $request
     * @param $leadId
     * @return mixed
     */
    public function sendLeadEmailToRep($request, $leadId);
}
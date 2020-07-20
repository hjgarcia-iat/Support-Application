<?php

namespace Tests\Feature;

use Tests\TestCase;

/**
 * Class CreateStudentSupportRequestForm
 * @package Tests\Feature
 */
class CreateStudentSupportRequestForm extends TestCase
{
    /**
     * @test
     */
    public function we_can_see_the_access_request_form_page()
    {
        $this->get(route('student_support.create'))->assertStatus(200)->assertViewIs('student_request.create');
    }
}
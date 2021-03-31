<?php

namespace Tests\Feature\RemoteSupport;

use Tests\TestCase;

/**
 * Class CreateStudentSupportRequestForm
 * @package Tests\Feature
 */
class CreateRemoteSupportRequestFormTest extends TestCase
{
    /**
     * @test
     */
    public function we_can_see_the_access_request_form_page()
    {
        $response = $this->get(route('remote_support.create'));

        $response->assertStatus(200)->assertViewIs('remote_support.create');
    }
}
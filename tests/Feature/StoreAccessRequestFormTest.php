<?php

namespace Tests\Feature;

use App\Zip;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Spinen\MailAssertions\MailTracking;
use Tests\TestCase;

/**
 * Class StoreAccessRequestFormTest
 * @package Tests\Feature
 */
class StoreAccessRequestFormTest extends TestCase
{
    use MailTracking, DatabaseMigrations, DatabaseTransactions;

    /**
     * @test
     */
    public function we_can_submit_the_access_request_form()
    {
        $response = $this->from(route('access_request.create'))
            ->post(route('access_request.store'), $this->validData());

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);

        $this->seeEmailWasSent();
        $this->seeEmailContains($this->validData()['sales_rep']);
        $this->seeEmailContains($this->validData()['first_name']);
        $this->seeEmailContains($this->validData()['last_name']);
        $this->seeEmailContains($this->validData()['email']);
        $this->seeEmailContains($this->validData()['district']);
        $this->seeEmailContains($this->validData()['school']);
        $this->seeEmailContains($this->validData()['zip_code']);
        $this->seeEmailContains($this->validData()['resource'][0]);
        $this->seeEmailContains($this->validData()['ebook_list'][0]);
        $this->seeEmailContains($this->validData()['access_type']);
        $this->seeEmailContains($this->validData()['version']);
        $this->seeEmailContains($this->validData()['time_frame']);
        $this->seeEmailContains($this->validData()['note']);
        $this->seeEmailTo(env('DESK_SUPPORT_EMAIL'));
    }

    /**
     * @test
     */
    public function we_can_submit_the_form_if_the_zip_code_is_not_present()
    {
        $response = $this->from(route('access_request.create'))
            ->post(route('access_request.store'), $this->validData(['zip_code' => '11111']));

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);


        $this->seeEmailWasSent();
        $this->seeEmailContains($this->validData()['sales_rep']);
        $this->seeEmailContains($this->validData()['first_name']);
        $this->seeEmailContains($this->validData()['last_name']);
        $this->seeEmailContains($this->validData()['email']);
        $this->seeEmailContains($this->validData()['district']);
        $this->seeEmailContains($this->validData()['school']);
        $this->seeEmailContains($this->validData()['resource'][0]);
        $this->seeEmailContains($this->validData()['ebook_list'][0]);
        $this->seeEmailContains($this->validData()['access_type']);
        $this->seeEmailContains($this->validData()['version']);
        $this->seeEmailContains($this->validData()['time_frame']);
        $this->seeEmailContains($this->validData()['note']);
        $this->seeEmailTo(env('DESK_SUPPORT_EMAIL'));
    }


    /**
     * @test
     */
    public function the_rep_field_is_required()
    {
        $response = $this->from(route('access_request.create'))
            ->post(route('access_request.store'), $this->validData([
                'sales_rep' => '',
            ]));

        $response->assertStatus(302);
        $response->assertRedirect('access-request');
        $response->assertSessionHasErrors('sales_rep');
        $this->seeEmailWasNotSent();
    }

    /**
     * @test
     */
    public function the_first_name_field_is_required()
    {
        $response = $this->from(route('access_request.create'))
            ->post(route('access_request.store'), $this->validData([
                'first_name' => '',
            ]));

        $response->assertStatus(302);
        $response->assertRedirect('access-request');
        $response->assertSessionHasErrors('first_name');
        $this->seeEmailWasNotSent();
    }

    /**
     * @test
     */
    public function the_last_name_field_is_required()
    {
        $response = $this->from(route('access_request.create'))
            ->post(route('access_request.store'), $this->validData([
                'last_name' => '',
            ]));

        $response->assertStatus(302);
        $response->assertRedirect('access-request');
        $response->assertSessionHasErrors('last_name');
        $this->seeEmailWasNotSent();
    }

    /**
     * @test
     */
    public function the_email_field_is_required()
    {
        $response = $this->from(route('access_request.create'))
            ->post(route('access_request.store'), $this->validData([
                'email' => '',
            ]));

        $response->assertStatus(302);
        $response->assertRedirect('access-request');
        $response->assertSessionHasErrors('email');
        $this->seeEmailWasNotSent();
    }

    /**
     * @test
     */
    public function the_email_field_is_valid()
    {
        $response = $this->from(route('access_request.create'))
            ->post(route('access_request.store'), $this->validData([
                'email' => 'invalid email',
            ]));

        $response->assertStatus(302);
        $response->assertRedirect('access-request');
        $response->assertSessionHasErrors('email');
        $this->seeEmailWasNotSent();
    }

    /**
     * @test
     */
    public function the_district_field_is_required()
    {
        $response = $this->from(route('access_request.create'))
            ->post(route('access_request.store'), $this->validData([
                'district' => '',
            ]));

        $response->assertStatus(302);
        $response->assertRedirect('access-request');
        $response->assertSessionHasErrors('district');
        $this->seeEmailWasNotSent();
    }

    /**
     * @test
     */
    public function the_resource_field_is_required()
    {
        $response = $this->from(route('access_request.create'))
            ->post(route('access_request.store'), $this->validData([
                'resource' => '',
            ]));

        $response->assertStatus(302);
        $response->assertRedirect('access-request');
        $response->assertSessionHasErrors('resource');
        $this->seeEmailWasNotSent();
    }

    /**
     * @test
     */
    public function the_time_frame_field_is_required()
    {

        $response = $this->from(route('access_request.create'))
            ->post(route('access_request.store'), $this->validData([
                'time_frame' => '',
            ]));

        $response->assertStatus(302);
        $response->assertRedirect('access-request');
        $response->assertSessionHasErrors('time_frame');
        $this->seeEmailWasNotSent();
    }

    /**
     * @test
     */
    public function the_zip_code_field_is_required()
    {
        $response = $this->from(route('access_request.create')
        )->post(route('access_request.store'), $this->validData([
            'zip_code' => '',
        ]));

        $response->assertStatus(302);
        $response->assertRedirect('access-request');
        $response->assertSessionHasErrors('zip_code');
        $this->seeEmailWasNotSent();
    }

    /**
     * @test
     */
    public function when_resource_is_equal_to_Ebook_the_ebook_list_field_is_required()
    {
        $response = $this->from(route('access_request.create'))
            ->post(route('access_request.store'), $this->validData(['resource' => ['Ebook'], 'ebook_list' => '']));

        $response->assertStatus(302);
        $response->assertRedirect('access-request');
        $response->assertSessionHasErrors('ebook_list');
        $this->seeEmailWasNotSent();
    }

    /**
     * @test
     */
    public function when_the_resource_field_is_haiku_the_access_type_field_is_required()
    {
        $response = $this->from(route('access_request.create'))
            ->post(route('access_request.store'), $this->validData(['resource' => ['Active Physics-Active Chemistry PD'], 'access_type' => '']));

        $response->assertStatus(302);
        $response->assertRedirect('access-request');
        $response->assertSessionHasErrors('access_type');
        $this->seeEmailWasNotSent();
    }

    /**
     * @test
     */
    public function when_the_resource_field_is_cyberpd_the_access_type_field_is_required()
    {
        $response = $this->from(route('access_request.create'))
            ->post(route('access_request.store'), $this->validData(['resource' => ['IMP/MM Cyberpd'], 'access_type' => '']));

        $response->assertStatus(302);
        $response->assertRedirect('access-request');
        $response->assertSessionHasErrors('access_type');
        $this->seeEmailWasNotSent();
    }

    /**
     * @test
     */
    public function that_when_resource_field_is_when_iqwst_demo_portal_the_version_field_is_required()
    {
        $response = $this->from(route('access_request.create'))
            ->post(route('access_request.store'), $this->validData(['resource' => ['IQWST Demo Portal'], 'version' => '']));

        $response->assertStatus(302);
        $response->assertRedirect('access-request');
        $response->assertSessionHasErrors('version');
        $this->seeEmailWasNotSent();
    }

    /**
     * @test
     */
    public function test_that_when_resource_field_is_california_demo_portal_the_version_field_is_required()
    {
        $response = $this->from(route('access_request.create'))
            ->post(route('access_request.store'), $this->validData(['resource' => ['California Demo Portal'], 'version' => '']));

        $response->assertStatus(302);
        $response->assertRedirect('access-request');
        $response->assertSessionHasErrors('version');
        $this->seeEmailWasNotSent();
    }

    /**
     * @test
     */
    public function test_that_when_resource_field_is_iqwst_ide_demo_the_version_field_is_required()
    {
        $response = $this->from(route('access_request.create'))
            ->post(route('access_request.store'), $this->validData(['resource' => ['IQWST IDE Demo'], 'version' => '']));

        $response->assertStatus(302);
        $response->assertRedirect('access-request');
        $response->assertSessionHasErrors('version');
        $this->seeEmailWasNotSent();
    }

    /**
     * @test
     */
    public function test_that_when_resource_field_is_iqwst_ide_demo_spanish_the_version_field_is_required()
    {
        $response = $this->from(route('access_request.create'))
            ->post(route('access_request.store'), $this->validData(['resource' => ['IQWST IDE Demo - Spanish'], 'version' => '']));

        $response->assertStatus(302);
        $response->assertRedirect('access-request');
        $response->assertSessionHasErrors('version');
        $this->seeEmailWasNotSent();
    }

    /**
     * Get valid form data
     *
     * @param array $overrides
     * @return array
     */
    private function validData($overrides = [])
    {
        return array_merge([
            'first_name' => 'John',
            'last_name'  => 'Doe',
            'email'      => 'jdoe@email.com',
            'district'   => 'District',
            'school'     => 'School',
            'resource'   => ['IQWST'],
            'access_type'   => 'Demo',
            'version'    => 'IQWST2.0.5',
            'sales_rep'  => 'test@email.com',
            'time_frame' => '2 weeks',
            'note'       => 'Note',
            'zip_code'   => factory(Zip::class)->create(['zip_code' => '00000'])->zip_code,
            'ebook_list' => ['Some Book'],
        ], $overrides);
    }
}
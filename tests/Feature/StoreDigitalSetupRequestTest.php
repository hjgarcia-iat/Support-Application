<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Spinen\MailAssertions\MailTracking;
use Tests\TestCase;

/**
 * Class StoreDigitalSetupRequestTest
 * @package Tests\Feature
 */
class StoreDigitalSetupRequestTest extends TestCase
{
    use MailTracking;

    /**
     * @test
     */
    public function the_name_field_is_required()
    {
        $response = $this->from(route('digital_setup_request.create'))
            ->post(route('digital_setup_request.store'), $this->validData(['name' => '']));

        $response->assertStatus(302);
        $response->assertRedirect(route('digital_setup_request.create'));
        $response->assertSessionHasErrors('name');
        $this->seeEmailWasNotSent();
    }

    public function test_email_field_is_required()
    {
        $response = $this->from(route('digital_setup_request.create'))
            ->post(route('digital_setup_request.store'), $this->validData(['email' => '']));

        $response->assertStatus(302);
        $response->assertRedirect(route('digital_setup_request.create'));
        $response->assertSessionHasErrors('email');
        $this->seeEmailWasNotSent();
    }

    public function test_email_field_is_valid()
    {
        $response = $this->from(route('digital_setup_request.create'))
            ->post(route('digital_setup_request.store'), $this->validData(['email' => 'invalid-email']));

        $response->assertStatus(302);
        $response->assertRedirect(route('digital_setup_request.create'));
        $response->assertSessionHasErrors('email');
        $this->seeEmailWasNotSent();
    }


    public function test_the_po_number_field_is_required()
    {
        $response = $this->from(route('digital_setup_request.create'))
            ->post(route('digital_setup_request.store'), $this->validData(['po_number' => '']));

        $response->assertStatus(302);
        $response->assertRedirect(route('digital_setup_request.create'));
        $response->assertSessionHasErrors('po_number');
        $this->seeEmailWasNotSent();
    }

    public function test_the_district_field_is_required()
    {
        $response = $this->from(route('digital_setup_request.create'))
            ->post(route('digital_setup_request.store'), $this->validData(['district' => '']));

        $response->assertStatus(302);
        $response->assertRedirect(route('digital_setup_request.create'));
        $response->assertSessionHasErrors('district');
        $this->seeEmailWasNotSent();
    }

    public function test_the_start_date_field_is_required()
    {
        $response = $this->from(route('digital_setup_request.create'))
            ->post(route('digital_setup_request.store'), $this->validData(['start_date' => '']));

        $response->assertStatus(302);
        $response->assertRedirect(route('digital_setup_request.create'));
        $response->assertSessionHasErrors('start_date');
        $this->seeEmailWasNotSent();
    }

    public function test_the_curriculum_field_is_required()
    {
        $response = $this->from(route('digital_setup_request.create'))
            ->post(route('digital_setup_request.store'), $this->validData(['curriculum' => '']));

        $response->assertStatus(302);
        $response->assertRedirect(route('digital_setup_request.create'));
        $response->assertSessionHasErrors('curriculum');
        $this->seeEmailWasNotSent();
    }

    public function test_the_district_manager_field_is_required()
    {
        $response = $this->from(route('digital_setup_request.create'))
            ->post(route('digital_setup_request.store'), $this->validData(['district_manager' => '']));

        $response->assertStatus(302);
        $response->assertRedirect(route('digital_setup_request.create'));
        $response->assertSessionHasErrors('district_manager');
        $this->seeEmailWasNotSent();
    }

    public function test_the_that_if_district_manager_field_is_yes_then_dm_name_field_is_required()
    {
        $response = $this->from(route('digital_setup_request.create'))
            ->post(route('digital_setup_request.store'), $this->validData(['district_manager' => 'yes', 'dm_name' => '']));

        $response->assertStatus(302);
        $response->assertRedirect(route('digital_setup_request.create'));
        $response->assertSessionHasErrors('dm_name');
        $this->seeEmailWasNotSent();
    }

    public function test_the_that_if_district_manager_field_is_yes_then_dm_email_field_is_required()
    {
        $response = $this->from(route('digital_setup_request.create'))
            ->post(route('digital_setup_request.store'), $this->validData(['district_manager' => 'yes', 'dm_email' => '']));

        $response->assertStatus(302);
        $response->assertRedirect(route('digital_setup_request.create'));
        $response->assertSessionHasErrors('dm_email');
        $this->seeEmailWasNotSent();
    }

    public function test_the_that_if_district_manager_field_is_yes_then_dm_email_field_is_valid()
    {
        $response = $this->from(route('digital_setup_request.create'))
            ->post(route('digital_setup_request.store'), $this->validData(['district_manager' => 'yes', 'dm_email' => 'invalid-email']));

        $response->assertStatus(302);
        $response->assertRedirect(route('digital_setup_request.create'));
        $response->assertSessionHasErrors('dm_email');
        $this->seeEmailWasNotSent();
    }

    public function test_the_that_if_district_manager_field_is_no_the_teacher_fields_are_required()
    {
        $response = $this->from(route('digital_setup_request.create'))
            ->post(route('digital_setup_request.store'), $this->validData(['district_manager' => 'no', 'teachers' => []]));

        $response->assertStatus(302);

        $response->assertSessionHasErrors('teachers');
        $this->seeEmailWasNotSent();
    }

    public function test_the_that_if_district_manager_field_is_no_the_teacher_name_is_required()
    {
        $response = $this->from(route('digital_setup_request.create'))
            ->post(route('digital_setup_request.store'), $this->validData(['district_manager' => 'no', 'teachers' => [
                [
                    'name'   => '',
                    'email'  => 'email@email.com',
                    'school' => 'school',
                ],
            ]]));

        $response->assertStatus(302);

        $response->assertSessionHasErrors('teachers.*.name');
        $this->seeEmailWasNotSent();
    }


    public function test_the_that_if_district_manager_field_is_no_then_teacher_email_field_is_required()
    {
        $response = $this->from(route('digital_setup_request.create'))
            ->post(route('digital_setup_request.store'), $this->validData(['district_manager' => 'no', 'teachers' => [
                ['name'   => 'Jane Doe',
                 'email'  => '',
                 'school' => 'school',],
            ]]));

        $response->assertStatus(302);
        $response->assertRedirect(route('digital_setup_request.create'));
        $response->assertSessionHasErrors('teachers.*.email');
        $this->seeEmailWasNotSent();
    }

    public function test_the_that_if_district_manager_field_is_no_then_teacher_email_field_is_valid()
    {
        $response = $this->from(route('digital_setup_request.create'))
            ->post(route('digital_setup_request.store'), $this->validData(['district_manager' => 'no', 'teachers' => [
                ['name'   => 'Jane Doe',
                 'email'  => 'invalid-email',
                 'school' => 'school',],
            ]]));

        $response->assertStatus(302);
        $response->assertRedirect(route('digital_setup_request.create'));
        $response->assertSessionHasErrors('teachers.*.email');
        $this->seeEmailWasNotSent();
    }

    public function test_the_that_if_district_manager_field_is_no_then_teacher_school_field_is_required()
    {
        $response = $this->from(route('digital_setup_request.create'))
            ->post(route('digital_setup_request.store'), $this->validData(['district_manager' => 'no', 'teachers' => [
                [
                    'name'   => 'Jane Doe',
                    'email'  => 'email@email.com',
                    'school' => '',
                ],
            ]]));

        $response->assertStatus(302);
        $response->assertRedirect(route('digital_setup_request.create'));
        $response->assertSessionHasErrors('teachers.*.school');
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
            'name'             => 'Jeff Doe',
            'email'            => 'jeffdoe@email.com',
            'po_number'        => '00000',
            'district'         => 'Some School District',
            'district_manager' => 'yes',
            'start_date'       => Carbon::now()->addMonth(1)->format('m/d/Y'),
            'curriculum'       => 'Some Curriculum',
            'dm_name'          => 'Jane Doe',
            'dm_email'         => 'jdoe@email.com',

        ], $overrides);
    }
}
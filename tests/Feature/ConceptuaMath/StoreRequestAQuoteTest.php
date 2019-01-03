<?php

namespace Tests\Feature\ConceptuaMath;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Spinen\MailAssertions\MailTracking;

class StoreRequestAQuoteTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions, MailTracking;

    /**
     * @test
     */
    public function the_first_name_field_is_required()
    {
        $response = $this->from(route('conceptua.request_quote.create'))
            ->post(route('conceptua.request_quote.store'), $this->validParams(['first_name' => '']));

        $response->assertStatus(302);
        $response->assertRedirect(route('conceptua.request_quote.create'));
        $response->assertSessionHasErrors('first_name');
    }


    /**
     * @test
     */
    public function the_last_name_field_is_required()
    {
        $response = $this->from(route('conceptua.request_quote.create'))
            ->post(route('conceptua.request_quote.store'), $this->validParams(['last_name' => '']));

        $response->assertStatus(302);
        $response->assertRedirect(route('conceptua.request_quote.create'));
        $response->assertSessionHasErrors('last_name');
    }

    /**
     * @test
     */
    public function the_email_field_is_required()
    {
        $response = $this->from(route('conceptua.request_quote.create'))
            ->post(route('conceptua.request_quote.store'), $this->validParams(['email' => '']));

        $response->assertStatus(302);
        $response->assertRedirect(route('conceptua.request_quote.create'));
        $response->assertSessionHasErrors('email');
    }

    /**
     * @test
     */
    public function the_email_field_is_valid()
    {
        $response = $this->from(route('conceptua.request_quote.create'))
            ->post(route('conceptua.request_quote.store'), $this->validParams(['email' => 'invalid-email']));

        $response->assertStatus(302);
        $response->assertRedirect(route('conceptua.request_quote.create'));
        $response->assertSessionHasErrors('email');
    }

    /**
     * @test
     */
    public function the_title_field_is_required()
    {
        $response = $this->from(route('conceptua.request_quote.create'))
            ->post(route('conceptua.request_quote.store'), $this->validParams(['title' => '']));

        $response->assertStatus(302);
        $response->assertRedirect(route('conceptua.request_quote.create'));
        $response->assertSessionHasErrors('title');
    }

    /**
     * @test
     */
    public function the_license_field_is_required()
    {
        $response = $this->from(route('conceptua.request_quote.create'))
            ->post(route('conceptua.request_quote.store'), $this->validParams(['license' => '']));

        $response->assertStatus(302);
        $response->assertRedirect(route('conceptua.request_quote.create'));
        $response->assertSessionHasErrors('license');
    }


    /**
     * @test
     */
    public function the_company_field_is_valid()
    {
        $response = $this->from(route('conceptua.request_quote.create'))
            ->post(route('conceptua.request_quote.store'), $this->validParams(['company' => '']));

        $response->assertStatus(302);
        $response->assertRedirect(route('conceptua.request_quote.create'));
        $response->assertSessionHasErrors('company');
    }

    /**
     * @test
     */
    public function the_city_field_is_valid()
    {
        $response = $this->from(route('conceptua.request_quote.create'))
            ->post(route('conceptua.request_quote.store'), $this->validParams(['city' => '']));

        $response->assertStatus(302);
        $response->assertRedirect(route('conceptua.request_quote.create'));
        $response->assertSessionHasErrors('city');
    }

    /**
     * @test
     */
    public function the_state_field_is_valid()
    {
        $response = $this->from(route('conceptua.request_quote.create'))
            ->post(route('conceptua.request_quote.store'), $this->validParams(['state' => '']));

        $response->assertStatus(302);
        $response->assertRedirect(route('conceptua.request_quote.create'));
        $response->assertSessionHasErrors('state');
    }

    /**
     * @param array $overrides
     * @return array
     */
    private function validParams($overrides = [])
    {
        return array_merge([
            'first_name' => 'Jane',
            'last_name' => 'Doe',
            'email' => 'email@email.com',
            'company' => 'School ABC',
            'title' => 'Teacher Title',
            'license' => 'The License',
            'city' => 'Some City',
            'state' => 'Some State',
        ], $overrides);
    }
}

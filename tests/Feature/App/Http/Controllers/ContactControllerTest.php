<?php

namespace Tests\Feature\App\Http\Controllers;

use App\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class ContactControllerTest
 * @package Tests\Feature
 */
class ContactControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_we_can_view_the_form()
    {
        $response = $this->get(route('support_ticket.create'));

        $response->assertStatus(200);
        $response->assertViewIs('support_ticket.create');
    }

    public function test_the_contact_form_can_submit_with_a_file()
    {
        $response = $this->from(route('support_ticket.create'))
            ->post(route('support_ticket.store'), $this->validData());

        $contact = Contact::whereEmail($this->validData()['email'])->first();

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'id'      => $contact->id,
        ]);

        $this->assertDatabaseHas('contacts', [
            'reason'   => $this->validData()['reason'],
            'name'     => $this->validData()['name'],
            'email'    => $this->validData()['email'],
            'district' => $this->validData()['district'],
            'subject'  => $this->validData()['subject'],
            'details'  => $this->validData()['details'],
        ]);
    }

    /**
     * Get valid form data
     *
     * @param array $overrides
     * @return array
     */
    private function validData($overrides = []): array
    {
        return array_merge([
            'reason'   => 'Curriculum Question',
            'name'     => 'Jane Doe',
            'email'    => 'jdoe@email.com',
            'district' => 'district',
            'subject'  => 'subject',
            'details'  => 'details',
        ], $overrides);
    }
}
<?php

namespace Tests\Feature\App\Http\Controllers;

use App\Ticket;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class TicketControllerTest
 * @package Tests\Feature
 */
class TicketControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_we_can_view_the_form()
    {
        $response = $this->get(route('support_ticket.create'));

        $response->assertStatus(200);
        $response->assertViewIs('support_ticket.create');
    }

    public function test_a_ticket_can_be_saved()
    {
        $response = $this->from(route('support_ticket.create'))
            ->post(route('support_ticket.store'), $this->validData());

        $ticket = Ticket::whereEmail($this->validData()['email'])->first();

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'id'      => $ticket->id,
        ]);

        $this->assertDatabaseHas('tickets', [
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
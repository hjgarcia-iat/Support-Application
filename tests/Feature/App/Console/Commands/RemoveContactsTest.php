<?php

namespace Tests\Feature\App\Console\Commands;

use App\Contact;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spinen\MailAssertions\MailTracking;
use Tests\TestCase;

class RemoveContactsTest extends TestCase
{
    use RefreshDatabase, MailTracking;

    public function test_it_deletes_contact_older_than_one_month()
    {
        $contactA = Contact::factory()->create(['created_at' => Carbon::now()->subMonths(4)]);
        $contactB = Contact::factory()->create(['created_at' => Carbon::now()->subMonths(3)]);
        $contactC = Contact::factory()->create(['created_at' => Carbon::now()->subMonths(2)]);
        $contactD = Contact::factory()->create(['created_at' => Carbon::now()->subMonths(1)]);
        $contactE = Contact::factory()->create();

        \Artisan::call('contacts:remove');

        $this->assertDatabaseMissing('contacts', ['id' => $contactA->id]);
        $this->assertDatabaseMissing('contacts', ['id' => $contactB->id]);
        $this->assertDatabaseMissing('contacts', ['id' => $contactC->id]);
        $this->assertDatabaseMissing('contacts', ['id' => $contactD->id]);
        $this->assertDatabaseHas('contacts', ['id' => $contactE->id]);

        $this->seeEmailWasSent();
        $this->seeEmailContains("4 records were deleted.");
    }
}
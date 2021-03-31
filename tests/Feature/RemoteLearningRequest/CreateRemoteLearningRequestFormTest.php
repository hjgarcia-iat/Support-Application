<?php

namespace Tests\Feature\RemoteLearningRequest;

use Tests\TestCase;

/**
 * Class CreateRemoteLearningRequestFormTest
 * @package Tests\Feature
 */
class CreateRemoteLearningRequestFormTest extends TestCase
{
    /**
     * @test
     */
    public function we_can_see_the_remote_learning_request_form()
    {
        $this->get(route('remote_learning_request.create'))
            ->assertStatus(200)
            ->assertViewIs('remote_learning_request.create');
    }
}
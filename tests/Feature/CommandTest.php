<?php

namespace Tests\Feature;

use Tests\TestCase;

class CommandTest extends TestCase
{
    /** @test */
    public function the_application_returns_a_successful_output()
    {
        $response = $this->post('/command', [
            'instructions' => "5 5\n1 2 N \nL M L M L M L M M\n3 3 E\nM M R M M R M R R M",
        ]);

        $response->assertStatus(200)
            ->assertJsonCount(1)
            ->assertJsonFragment(['output' => "1 3 N\n5 1 E"]);
    }

    /** @test */
    public function instructions_are_required()
    {
        $response = $this->post('/command');

        $response->assertStatus(302)
            ->assertInvalid(['instructions']);
    }

    /** @test */
    public function instructions_must_have_at_least_the_plateau_coordinates_and_one_rover_instructions()
    {
        $response = $this->post('/command', [
            'instructions' => "5 5\n1 2 N",
        ]);

        $response->assertStatus(302)
            ->assertInvalid(['instructions']);
    }

    /** @test */
    public function instructions_must_have_the_plateau_coordinates_and_two_lines_of_instructions_for_each_rover()
    {
        $response = $this->post('/command', [
            'instructions' => "5 5\n1 2 N \nL M L M L M L M M\n3 3 E",
        ]);

        $response->assertStatus(302)
            ->assertInvalid(['instructions']);
    }
}

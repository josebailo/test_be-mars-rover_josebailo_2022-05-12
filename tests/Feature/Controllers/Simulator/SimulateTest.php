<?php

namespace Tests\Feature\Controllers\Simulator;

use Tests\TestCase;

class SimulateTest extends TestCase
{
    /** @test */
    public function the_application_returns_a_successful_output()
    {
        $instructions = "5 5\n1 2 N\nL M L M L M L M M\n3 3 E\nM M R M M R M R R M";
        $response = $this->post(route('simulate'), [
            'instructions' => $instructions,
        ]);

        $response->assertRedirect(route('simulator.raw'))
            ->assertSessionHas('instructions', $instructions)
            ->assertSessionHas('output', "1 3 N\n5 1 E");
    }

    /** @test */
    public function instructions_are_required()
    {
        $response = $this->post(route('simulate'));

        $response->assertStatus(302)
            ->assertSessionHasErrors('instructions');
    }

    /** @test */
    public function instructions_must_have_an_odd_number_of_lines()
    {
        $response = $this->post(route('simulate'), [
            'instructions' => "5 5\n1 2 N",
        ]);

        $response->assertStatus(302)
            ->assertSessionHasErrors([
                'instructions' => __('exceptions.instructions.invalid_minimum_of_lines'),
            ]);
    }

    /** @test */
    public function instructions_must_have_odd_amount_of_lines()
    {
        $response = $this->post(route('simulate'), [
            'instructions' => "5 5\n1 2 N \nL M L M L M L M M\n3 3 E",
        ]);

        $response->assertStatus(302)
            ->assertSessionHasErrors([
                'instructions' => __('exceptions.instructions.invalid_odd_amount_of_lines'),
            ]);
    }

    /** @test */
    public function instructions_must_have_valid_plateau_coordinates()
    {
        $invalidInstructions = [
            "0 5\n1 2 N \nL M L M L M L M M",
            "5 0\n1 2 N \nL M L M L M L M M",
            "-1 5\n1 2 N \nL M L M L M L M M",
            "5 -1\n1 2 N \nL M L M L M L M M",
            "5 5 \n1 2 N \nL M L M L M L M M",
            "5  5\n1 2 N \nL M L M L M L M M",
        ];

        foreach ($invalidInstructions as $instructions) {
            $response = $this->post(route('simulate'), ['instructions' => $instructions]);
            $response->assertStatus(302)
                ->assertSessionHasErrors([
                    'instructions' => __('exceptions.instructions.invalid_plateau_coordinates'),
                ]);
        }
    }

    /** @test */
    public function instructions_must_have_valid_situation_for_the_rovers()
    {
        $invalidInstructions = [
            "5 5\n-1 2 N\nM M M",
            "5 5\n1 -1 N\nM M M",
            "5 5\n1 2 N \nM M M",
            "5 5\n 1 2 N\nM M M",
            "5 5\n1 2 Z\nM M M",
            "5 5\n1 2  Z\nM M M",
            "5 5\n1  2 Z\nM M M",
        ];

        foreach ($invalidInstructions as $instructions) {
            $response = $this->post(route('simulate'), ['instructions' => $instructions]);
            $response->assertStatus(302)
                ->assertSessionHasErrors([
                    'instructions' => __('exceptions.instructions.invalid_rover_situation'),
                ]);
        }
    }

    /** @test */
    public function instructions_must_have_valid_movements_for_the_rovers()
    {
        $invalidInstructions = [
            "5 5\n1 2 N\nM M Z",
            "5 5\n1 2 N\nM Z M",
            "5 5\n1 2 N\nZ M M",
            "5 5\n1 2 N\n M M M",
            "5 5\n1 2 N\nM M  M",
            "5 5\n1 2 N\nM  M M",
            // To test the space at the end of the movements there must
            // be two rovers because Laravel automatically trims the inputs
            "5 5\n1 2 N\nM M M \n3 1 N\nM M M",
        ];

        foreach ($invalidInstructions as $instructions) {
            $response = $this->post(route('simulate'), ['instructions' => $instructions]);
            $response->assertStatus(302)
                ->assertSessionHasErrors([
                    'instructions' => __('exceptions.instructions.invalid_rover_movements'),
                ]);
        }
    }
}

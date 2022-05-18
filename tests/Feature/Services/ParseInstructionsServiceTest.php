<?php

namespace Tests\Feature\Services;

use App\Entities\Instructions;
use App\Services\ParseInstructionsService;
use Tests\TestCase;

class ParseInstructionsServiceTest extends TestCase
{
    /** @test */
    public function returns_an_instance_of_instructions_entity()
    {
        $parseInstructionsService = new ParseInstructionsService();
        $instructions = $parseInstructionsService->parse("5 7\n1 2 N \nL M L M L M L M M\n3 3 E\nM M R M M R M R R M");
        $this->assertInstanceOf(Instructions::class, $instructions);
    }
}

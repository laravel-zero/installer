<?php

namespace Tests\Unit;

use Mockery;
use Tests\TestCase;
use App\Commands\NewCommand;
use LaravelZero\Framework\Contracts\Providers\Composer as ComposerContract;

class NewCommandTest extends TestCase
{
    public function tearDown()
    {
        Mockery::close();
    }

    /** @test */
    public function it_checks_if_command_is_registered(): void
    {
        $command = $this->app->getContainer()
            ->make(NewCommand::class);

        $this->assertArrayHasKey($command->getName(), $this->app->all());
    }

    /** @test */
    public function it_creates_a_new_project(): void
    {
        $composer = Mockery::mock(ComposerContract::class);
        $composer->shouldReceive('createProject')
            ->once()
            ->andReturn($composer);

        $this->app->getContainer()
            ->instance(ComposerContract::class, $composer);

        $command = $this->app->getContainer()
            ->make(NewCommand::class);

        $this->app->add($command);
        $this->app->call($command->getName(), ['name' => 'dummy']);
        $output = $this->app->output();

        $this->assertTrue(
            strpos($output, 'Crafting application..') !== false
        );

        $this->assertTrue(
            strpos($output, 'Application ready! Build something amazing.') !== false
        );
    }
}

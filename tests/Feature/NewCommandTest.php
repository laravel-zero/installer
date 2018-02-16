<?php

namespace Tests\Feature;

use Mockery;
use Tests\TestCase;
use App\Commands\NewCommand;
use Illuminate\Support\Facades\Artisan;
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
        $this->assertArrayHasKey('new', Artisan::all());
    }

    /** @test */
    public function it_creates_a_new_project(): void
    {
        $composer = Mockery::mock(ComposerContract::class);
        $composer->shouldReceive('createProject')
            ->once()
            ->andReturn(true);

        $this->app->instance(ComposerContract::class, $composer);

        Artisan::call('new', ['name' => 'dummy']);

        $output = Artisan::output();

        $this->assertContains('Crafting application..', $output);

        $this->assertContains('Application ready! Build something amazing.', $output);
    }
}

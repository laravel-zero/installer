<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Artisan;
use LaravelZero\Framework\Contracts\Providers\Composer as ComposerContract;

class NewCommandTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function checksIfTheCommandIsRegisteredTest(): void
    {
        $this->assertArrayHasKey('new', Artisan::all());
    }

    /** @test */
    public function createsNewProjectTest(): void
    {
        $composerMock = $this->createMock(ComposerContract::class);
        $composerMock->expects($this->once())
            ->method('createProject')
            ->willReturn(true);

        $this->app->instance(ComposerContract::class, $composerMock);

        Artisan::call('new', ['name' => 'dummy']);

        $output = Artisan::output();

        $this->assertContains('Crafting application..', $output);

        $this->assertContains('Application ready! Build something amazing.', $output);
    }
}

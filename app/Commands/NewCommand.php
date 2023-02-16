<?php

namespace App\Commands;

use LaravelZero\Framework\Commands\Command;
use LaravelZero\Framework\Contracts\Providers\ComposerContract;
use Symfony\Component\Process\Process;

class NewCommand extends Command
{
    private const DEV_BRANCH = 'dev-master';

    /** {@inheritdoc} */
    protected $signature = 'new {name=laravel-zero} {--dev : Installs the latest "development" release}';

    /** {@inheritdoc} */
    protected $description = 'Create a new Laravel Zero application';

    public function handle(ComposerContract $composer): void
    {
        $appPath = $this->argument('name');
        $appName = basename($appPath);

        $this->info('Crafting application..');

        $developmentBranch = ($this->option('dev') ? ':'.self::DEV_BRANCH : null);

        $composer->createProject(
            'laravel-zero/laravel-zero'.$developmentBranch,
            $appPath,
            ['--prefer-dist']
        );

        $this->line('');

        $process = Process::fromShellCommandline(
            "php application app:rename {$appName}",
            $appPath
        )->mustRun();

        $this->info($process->getOutput());

        $this->comment('Application ready! Build something amazing.');
    }
}

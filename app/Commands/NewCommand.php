<?php

namespace App\Commands;

use LaravelZero\Framework\Commands\Command;
use LaravelZero\Framework\Contracts\Providers\ComposerContract;
use Symfony\Component\Process\Process;

use function Laravel\Prompts\info;
use function Laravel\Prompts\text;

class NewCommand extends Command
{
    private const DEV_BRANCH = 'dev-master';

    /** {@inheritdoc} */
    protected $signature = 'new {name? : The name of the application}
                {--dev : Install the latest "development" release}';

    /** {@inheritdoc} */
    protected $description = 'Create a new Laravel Zero application';

    public function handle(ComposerContract $composer): void
    {
        $appPath = $this->argument('name') ?: text(label: 'Application name', required: true);

        $appName = basename($appPath);

        info('Crafting application...');

        $developmentBranch = ($this->option('dev') ? ':'.self::DEV_BRANCH : null);

        $composer->createProject(
            'laravel-zero/laravel-zero'.$developmentBranch,
            $appPath,
            ['--prefer-dist']
        );

        info('');

        $process = Process::fromShellCommandline(
            "php application app:rename {$appName}",
            $appPath
        )->mustRun();

        info($process->getOutput());

        $this->comment('Application ready! Build something amazing.');
    }
}

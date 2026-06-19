<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\PermissionName;
use Illuminate\Console\Command;

final class Playground extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'play';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'happy happy happy';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        dd(
            PermissionName::cases(),
        );
    }
}

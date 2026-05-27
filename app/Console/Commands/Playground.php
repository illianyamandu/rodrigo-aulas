<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;

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
        $usuarioLogado = Auth::user();

        if ($usuarioLogado->hasPermissionTo('list-user')) {
            // só entra quem pode listar usuários
        }
    }
}

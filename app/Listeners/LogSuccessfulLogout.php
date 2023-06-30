<?php

namespace App\Listeners;

use App\Models\Bitacora;
use Illuminate\Auth\Events\Logout;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;

class LogSuccessfulLogout
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Logout $event): void
    {
        if (Auth::check()) {
            $bitacora = new Bitacora();
            $bitacora->accion = 'cierre de sesion';
            $bitacora->fecha_hora = now();
            $bitacora->fecha = now()->format('Y-m-d');
            $bitacora->user_id = Auth::user()->id;
            $bitacora->save();
        }
    }
}

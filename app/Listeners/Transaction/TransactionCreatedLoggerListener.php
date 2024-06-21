<?php

namespace App\Listeners\Transaction;

use App\Events\Transaction\TransactionCreatedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

readonly class TransactionCreatedLoggerListener
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
    public function handle(TransactionCreatedEvent $event): void
    {
        //
    }
}

<?php

namespace App\Listeners\Transaction;

use App\Events\Transaction\TransactionCreatedEvent;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

readonly class TransactionCreatedSendMailListener
{
    public function __construct(
        private Mailer $mailer
    ) { }

    public function handle(TransactionCreatedEvent $event): void
    {
//        $this->mailer->to($event->transaction->author->email)
//            ->send()
    }
}

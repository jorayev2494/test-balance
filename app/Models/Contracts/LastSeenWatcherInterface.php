<?php

declare(strict_types=1);

namespace App\Models\Contracts;

interface LastSeenWatcherInterface
{
    public function changeLastSeen(): void;
}

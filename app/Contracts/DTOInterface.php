<?php

namespace App\Contracts;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;

interface DTOInterface extends Arrayable
{
    public static function makeFromRequest(Request $request): static;
}

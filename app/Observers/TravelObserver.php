<?php

namespace App\Observers;

use App\Models\Travel;
use Illuminate\Support\Str;

class TravelObserver
{
    public function creating(Travel $travel) : void
    {
        if (!empty($travel->slug)) {
            return;
        }

        $travel->slug = empty($travel->name)
            ? Str::uuid()
            : Str::slug($travel->name);
    }
}

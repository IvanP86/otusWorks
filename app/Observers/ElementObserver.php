<?php

namespace App\Observers;

use App\Models\Element;
use Illuminate\Support\Facades\Log;

class ElementObserver
{
    /**
     * Handle the Element "created" event.
     */
    public function created(Element $element): void
    {
        Log::info("Создан новый товар id = " . $element->id);
    }

    /**
     * Handle the Element "updated" event.
     */
    public function updated(Element $element): void
    {
        Log::info("Изменен товар id = " . $element->id);
    }

    /**
     * Handle the Element "deleted" event.
     */
    public function deleted(Element $element): void
    {
        Log::alert("Удален товар id = " . $element->id);
    }

    /**
     * Handle the Element "restored" event.
     */
    public function restored(Element $element): void
    {
        //
    }

    /**
     * Handle the Element "force deleted" event.
     */
    public function forceDeleted(Element $element): void
    {
        //
    }
}

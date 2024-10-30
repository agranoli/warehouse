<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Item;
use Illuminate\Http\Response;

class DeleteController extends Controller
{
    /**
     * Delete the specified event.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyEvent(int $id): Response
    {
        $event = Event::findOrFail($id);

        $event->delete();

        return response()->noContent();
    }

    /**
     * Delete the specified item.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyItem(int $id): Response
    {
        $item = Item::findOrFail($id);

        $item->delete();

        return response()->noContent();
    }
}

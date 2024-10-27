<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Rent;
use Carbon\Carbon;

class UpdateAvailableItems extends Command
{
    protected $signature = 'items:update-availability';
    protected $description = 'Update available quantity of items based on expired rents';

    public function handle()
    {
        $expiredRents = Rent::where('date_to', '<', Carbon::now())->get();

        foreach ($expiredRents as $rent) {
            $availableItem = $rent->item->availableItem;
            if ($availableItem) {
                $availableItem->available += $rent->quantity;
                $availableItem->save();
            }
        }

        $this->info('Available quantities updated successfully.');
    }
}

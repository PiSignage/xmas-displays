<?php

namespace App\Observers;

use App\Models\Display;
use Illuminate\Support\Facades\Storage;

class DisplayObserver
{
    /**
     * Handle the Display "created" event.
     */
    public function created(Display $display): void
    {
        //
    }

    /**
     * Handle the Display "updated" event.
     */
    public function updated(Display $display): void
    {
        // Check of images is not null
        if (!is_null($display->getOriginal('images'))) {
            // Check of difference between the current images and the new images
            $imagesToDelete = array_diff($display->getOriginal('media'), $display->images);
            // Loop over imagesToDelete
            foreach ($imagesToDelete as $image) {
                // Delete the image
                Storage::disk('display_images')->delete($image);
            }
        }
    }

    /**
     * Handle the Display "deleted" event.
     */
    public function deleted(Display $display): void
    {
        // Check of images is not null
        if (!is_null($display->images)) {
            // Loop over images
            foreach ($display->images as $image) {
                // Delete image
                Storage::disk('display_images')->delete($image);
            }
        }
    }

    /**
     * Handle the Display "restored" event.
     */
    public function restored(Display $display): void
    {
        //
    }

    /**
     * Handle the Display "force deleted" event.
     */
    public function forceDeleted(Display $display): void
    {
        //
    }
}

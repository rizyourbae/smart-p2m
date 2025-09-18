<?php

namespace App\Observers;

use App\Models\Reviewer;
use Spatie\Permission\Models\Role;

class ReviewerObserver
{
    /**
     * Handle the Reviewer "created" event.
     *
     * @param  \App\Models\Reviewer  $reviewer
     * @return void
     */
    public function created(Reviewer $reviewer)
    {
        // Assign role 'reviewer' to the newly created reviewer
        $reviewer->assignRole('reviewer');
    }

    /**
     * Handle the Reviewer "updated" event.
     */
    public function updated(Reviewer $reviewer): void
    {
        //
    }

    /**
     * Handle the Reviewer "deleted" event.
     */
    public function deleted(Reviewer $reviewer): void
    {
        //
    }

    /**
     * Handle the Reviewer "restored" event.
     */
    public function restored(Reviewer $reviewer): void
    {
        //
    }

    /**
     * Handle the Reviewer "force deleted" event.
     */
    public function forceDeleted(Reviewer $reviewer): void
    {
        //
    }
}

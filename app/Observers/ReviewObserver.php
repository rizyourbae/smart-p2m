<?php

namespace App\Observers;

use App\Models\Review;

class ReviewObserver
{
    /**
     * Handle the Review "created" event.
     */
    public function created(Review $review): void
    {
        //
    }

    /**
     * Handle the Review "updated" event.
     */
    public function updated(Review $review): void
    {
        // Cek apakah kolom status atau tahapan_review baru saja diubah menjadi 'selesai'
        if (
            $review->wasChanged('status') && $review->status === 'selesai' ||
            $review->wasChanged('tahapan_review') && $review->tahapan_review === 'selesai'
        ) {
            // Ambil proposal induk dari review ini
            $proposal = $review->proposal;

            // Hitung semua review yang terkait dengan proposal ini
            $totalReviews = $proposal->reviews()->count();

            // Hitung semua review yang statusnya sudah 'selesai'
            $completedReviews = $proposal->reviews()->where('status', 'selesai')->count();

            // JIKA jumlah total review SAMA DENGAN jumlah review yang selesai,
            // DAN status proposal saat ini masih 'dalam_penilaian'
            if ($totalReviews > 0 && $totalReviews === $completedReviews && $proposal->status === 'dalam_penilaian') {
                // MAKA, update status proposal menjadi 'menunggu_keputusan'
                $proposal->update(['status' => 'menunggu_keputusan']);
            }
        }
    }

    /**
     * Handle the Review "deleted" event.
     */
    public function deleted(Review $review): void
    {
        //
    }

    /**
     * Handle the Review "restored" event.
     */
    public function restored(Review $review): void
    {
        //
    }

    /**
     * Handle the Review "force deleted" event.
     */
    public function forceDeleted(Review $review): void
    {
        //
    }
}

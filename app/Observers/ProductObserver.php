<?php

namespace App\Observers;
use App\Models\Product;
use App\Models\User;
use App\Notifications\ProductApprovalNotification;
class ProductObserver
{
    /**
     * Handle the Product "created" event.
     */
   public function created(Product $product)
{
    $admins = User::role('admin')->get();

    foreach ($admins as $admin) {
        $admin->notify(new ProductApprovalNotification($product));
    }
}

    /**
     * Handle the Product "updated" event.
     */
   public function updated(Product $product)
    {
        if ($product->isDirty('status')) {

            if ($product->status == 'approved') {
                // Admin approval logic
                \Log::info("Product Approved: " . $product->id);

                // Yahan email / notification bhi bhej sakte ho
            }

            if ($product->status == 'rejected') {
                \Log::info("Product Rejected: " . $product->id);
            }
        }
    }

    /**
     * Handle the Product "deleted" event.
     */
    public function deleted(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "restored" event.
     */
    public function restored(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "force deleted" event.
     */
    public function forceDeleted(Product $product): void
    {
        //
    }
}

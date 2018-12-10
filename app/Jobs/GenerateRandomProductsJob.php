<?php

namespace App\Jobs;

use App\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class GenerateRandomProductsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    private $countProducts;


    /**
     * Create a new job instance.
     *
     * @param int $count
     */
    public function __construct(int $count = 1)
    {
        $this->countProducts = $count;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        factory(Product::class, $this->countProducts)->create();
    }

    public function tags(): array
    {
        return ['create-products', 'create-products', $this->countProducts];
    }
}

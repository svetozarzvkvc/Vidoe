<?php

namespace Database\Seeders;

use App\Models\Subscription;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    private $subscriptions = [
        [
            "subscriber_id" => 1,
            "subscribed_id" => 2
        ],
        [
            "subscriber_id" => 2,
            "subscribed_id" => 1
        ],
        [
            "subscriber_id" => 3,
            "subscribed_id" => 2
        ],
        [
            "subscriber_id" => 4,
            "subscribed_id" => 1
        ],
        [
            "subscriber_id" => 2,
            "subscribed_id" => 3
        ]
    ];
    public function run(): void
    {
        //
        foreach ($this->subscriptions as $subscription){
            Subscription::create($subscription);
        }
    }
}

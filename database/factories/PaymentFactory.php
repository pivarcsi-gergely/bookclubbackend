<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'member_id' => $this->faker->numberBetween(1, 10),
            'amount' => $this->faker->numberBetween(1000, 15000),
            'paid_at' => Carbon::now()->subDays(random_int(0, 49))
        ];
    }
}

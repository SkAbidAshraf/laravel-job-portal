<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\JobType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\=JobListing>
 */
class JobListingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->jobTitle,
            'user_id' => User::inRandomOrder()->first(),  // Use existing user ID
            'category_id' => Category::inRandomOrder()->first(),  // Use existing category ID
            'job_type_id' => JobType::inRandomOrder()->first(),  // Use existing job type ID
            'vacancy' => $this->faker->numberBetween(1, 10),
            'salary' => $this->faker->randomElement(['20000-30000', '30000-50000', null]),
            'location' => $this->faker->city,
            'description' => $this->faker->paragraphs(3, true),
            'benefits' => $this->faker->sentences(3, true),
            'responsibilities' => $this->faker->sentences(5, true),
            'qualifications' => $this->faker->sentences(3, true),
            'keywords' => implode(', ', $this->faker->words(5)),
            'experience' => $this->faker->randomElement(['none', '1', '2', '3', '4', '5']), 
            'company_name' => $this->faker->company,
            'company_location' => $this->faker->city,
            'company_website' => $this->faker->url,
            'email' => $this->faker->companyEmail,
            'mobile' => $this->faker->phoneNumber,
            'status' => $this->faker->randomElement([0, 1]),
            'featured' => $this->faker->randomElement([0, 1]),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

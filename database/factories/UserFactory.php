<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Simulasi foto dummy menggunakan fake image
        $fakeImage = UploadedFile::fake()->image(Str::random(10) . '.jpg');

        // Simpan ke folder 'photos' di public storage dan ambil path-nya
        $path = $fakeImage->store('photos', 'public');
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => bcrypt('password'), // Ganti sesuai kebutuhan
            'phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
            'joining_date' => $this->faker->date(),
            'photo' => $path, // Simpan path foto
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}

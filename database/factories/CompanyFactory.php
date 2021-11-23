<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\User;
use DavidBadura\FakerMarkdownGenerator\FakerProvider as FakerMarkdownProvider;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\File;

class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $this->faker->addProvider(new FakerMarkdownProvider($this->faker));

        return [
            'owner_id' => User::factory()->create()->id,
            'name' => $this->faker->company,
            'tag' => $this->faker->word,
            'slogan' => $this->faker->sentence(3),
            'website_url' => $this->faker->url,
            'contact_email' => $this->faker->safeEmail,
            'recruitment_open' => mt_rand(0, 1),
            'logo_path' => $this->generateLogo(),
            'logo_border' => mt_rand(0, 1),
            'information' => $this->faker->markdown(),
            'rules' => $this->faker->markdown(),
            'requirements' => $this->faker->markdown(),
            'display_members' => mt_rand(0, 1),
            'show_tag' => mt_rand(0, 1),
            'hide_email' => mt_rand(0, 1),
            'receive_emails' => mt_rand(0, 1),
        ];
    }

    private function generateLogo(): string
    {
        $logoPath = storage_path('app/public/images/vtc/logo');

        // Create the path(s) if they don't exist yet
        if (!File::exists($logoPath)) {
            File::makeDirectory($logoPath, 0755, true);
        }

        // Generate a random image, and store it
        $logo = $this->faker->image($logoPath, 500, 500, null, false);

        // Return the asset path
        return "storage/images/vtc/logo/$logo";
    }

    /**
     * Configure the model factory.
     *
     * @return self
     */
    public function configure(): self
    {
        // After creating the company, set the owner's company_id.
        return $this->afterCreating(function (Company $company) {
            $company->owner()->update([
                'company_id' => $company->id,
            ]);
        });
    }
}

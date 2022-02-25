<?php

namespace Database\Factories;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Post;
use Illuminate\Support\Str;
use \Cviebrock\EloquentSluggable\Services\SlugService;


class PostFactory extends Factory
{
    protected $model = Post::class;
    
    
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(){
        $slug = $this->faker->company;

        return [
            'user_id' => User::all()->random()->id,
            'title' => $slug,
            'description' => $this->faker->text,
            // 'slug' => SlugService::createSlug(Post::class, 'slug', $slug),
            'slug' => Str::slug($slug),
        ];

    }
}

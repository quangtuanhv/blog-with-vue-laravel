<?php

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\SubCategory;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'sport',
            'technical',
            'life',
            'fashion',
            'hot girls',
            'travel',
        ];
        $subCategories = [
            'Fashion',
            'Food',
            'Recipes',
            'Love & sex',
            'Health & fitness',
            'Home & garden',
            'Women',
            'Men',
            'Family',
            'Travel',
            'Money',
            'Books',
            'Music',
        ];
        Category::truncate();
        SubCategory::truncate();

        foreach ($categories as $value) {
            factory(Category::class)->create([
                'name'=>$value,
            ]);
        }

        foreach ($subCategories as $value) {
            factory(SubCategory::class)->create([
                'name'=>$value,
            ]);
        }

    }
}

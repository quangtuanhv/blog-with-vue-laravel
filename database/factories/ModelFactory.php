<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\User;
use App\Models\Role;

$factory->define(User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => '123123',
        'birthday' => $faker->date(),
        'address' => $faker->streetAddress(),
        'phone' => $faker->tollFreePhoneNumber(),
        'avatar' => $faker->imageUrl(124, 124, 'fashion', true, 'Faker', false),
        'status' => $faker->randomElement([0, 1]),
        'token_confirm' => str_random(10),
        'gender' => $faker->randomElement([0, 1]),
        'about' => $faker->text(),
        'remember_token' => str_random(10),
    ];
});

$factory->define(Role::class, function (Faker\Generator $faker) {
    static $typeId;

    return [
        'name' => $faker->word,
        'type' => $faker->randomElement([1, 2]),
    ];
});
$factory->state(User::class, Role::ROLE_ADMIN, function () {
    return [
        'name' => 'Admin',
        'email' => 'admin@gmail.com',
        'status' => User::ACTIVE,
    ];
});
$factory->define(App\Models\Tag::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'created_at' => $faker->dateTime(),
        'updated_at' => $faker->dateTime(),
    ];
});
$factory->define(App\Models\Category::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'created_at' => $faker->dateTime(),
        'updated_at' => $faker->dateTime(),
    ];
});

$factory->define(App\Models\Media::class, function (Faker\Generator $faker) {
    return [
        'url' => $faker->imageUrl(),
        'type' => rand(0, 1),
    ];
});

$factory->define(App\Models\Category::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
    ];
});
$factory->define(App\Models\SubCategory::class, function (Faker\Generator $faker) {
    static $CategoryId;

    return [
        'category_id'=>$faker->randomElement($CategoryId ?: $CategoryId = App\Models\Category::pluck('id')->toArray()),
        'name' => $faker->name,
    ];
});

$factory->define(App\Models\Post::class, function (Faker\Generator $faker) {
    static $SubCategoryId;

    return [
        'title' => $faker->name,
        'content' => $faker->text,
        'sub_category_id'=> $faker->randomElement($SubCategoryId ?: $SubCategoryId = App\Models\SubCategory::pluck('id')->toArray()),
    ];
});

<?php

namespace App\Repositories\Eloquent;

use Carbon\Carbon;
use App\Models\Tag;
use App\Repositories\Contracts\TagInterface;

class TagRepository extends BaseRepository implements TagInterface
{
    public function model()
    {
        return Tag::class;
    }

    public function getOrCreate($tags)
    {
        if (!is_array($tags)) {
            return false;
        }

        $newTags = [];
        $oldTags = [];

        foreach ($tags as $tag) {
            if (empty($tag['id'])) {
                $newTags[] = ['name' => strtolower($tag['name'])];
            } else {
                $oldTags[] = $tag['id'];
            }
        }

        return [
            'old' => $oldTags,
            'new' => $newTags,
        ];
    }

    public function deleteFromPost($post)
    {
        if (!is_null($post)) {
            $currentDay = Carbon::Now();
            $post->tags->each(function ($tag) use ($post, $currentDay) {
                $tag->campaigns()->updateExistingPivot($post->id, ['deleted_at' => $currentDay]);
            });

            return true;
        }

        return false;
    }

    public function openFromCampaign($post)
    {
        if (!is_null($post)) {
            $post->tags->each(function ($tag) use ($post) {
                $tag->campaigns()->updateExistingPivot($post->id, ['deleted_at' => null]);
            });

            return true;
        }

        return false;
    }
}

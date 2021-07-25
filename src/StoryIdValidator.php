<?php

namespace PierreMiniggio\InstagramStoryPoster;

class StoryIdValidator
{
    public function validate(string $storyId): bool
    {
        preg_match('/^[0-9]+_[0-9]+$/', $storyId, $matches);

        return ! ! $matches;
    }
}

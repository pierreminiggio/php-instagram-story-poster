<?php

namespace PierreMiniggio\InstagramStoryPoster;

class StoryIdsValidator
{
    public function validate(string $response): bool|array
    {
        if (! $response) {
            return false;
        }

        $jsonResponse = json_decode($response, true);

        if (! $jsonResponse) {
            return false;
        }

        return $jsonResponse;
    }
}

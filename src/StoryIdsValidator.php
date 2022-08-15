<?php

namespace PierreMiniggio\InstagramStoryPoster;

class StoryIdsValidator
{
    public function validate(string $response): bool|array
    {
        if (! $response) {
            return false;
        }

        $response = trim($response);

        if (str_starts_with($response, 'Code entered')) {
            $response = '[' . explode('[', $response, 2)[1];
        }

        $jsonResponse = json_decode($response, true);

        if (! $jsonResponse) {
            return false;
        }

        return $jsonResponse;
    }
}

<?php

namespace PierreMiniggio\InstagramStoryPoster;

use Exception;
use PierreMiniggio\GithubActionRunStarterAndArtifactDownloader\GithubActionRunStarterAndArtifactDownloader;
use PierreMiniggio\GithubActionRunStarterAndArtifactDownloader\GithubActionRunStarterAndArtifactDownloaderFactory;

class InstagramStoryPoster
{
    private GithubActionRunStarterAndArtifactDownloader $runnerAndDownloader;
    private StoryIdsValidator $validator;

    public function __construct()
    {
        $this->runnerAndDownloader = (new GithubActionRunStarterAndArtifactDownloaderFactory())
            ->make()
        ;
        $this->validator = new StoryIdsValidator();
    }

    /**
     * @param array<string, mixed> $inputs
     * @param int $refreshTime in seconds
     *
     * @return string[] instagram story ids
     *
     * @throws InstagramStoryPosterException
     */
    public function upload(
        string $token,
        string $owner,
        string $repo,
        int $refreshTime = 30,
        int $retries = 0,
        array $inputs = [],
        string $ref = 'main'
    ): array
    {
        try {
            $files = $this->runnerAndDownloader->runActionAndGetArtifacts(
                $token,
                $owner,
                $repo,
                'upload-story.yml',
                $refreshTime,
                $retries,
                $inputs,
                $ref
            );
        } catch (Exception $e) {
            throw new InstagramStoryPosterException($e->getMessage());
        }

        if (! $files) {
            throw new InstagramStoryPosterException('No artifact file !');
        }

        $file = $files[0];
        $response = trim(file_get_contents($file));
        unlink($file);

        $validatedResponse = $this->validator->validate($response);

        if ($validatedResponse === false) {
            throw new InstagramStoryPosterException('Action failed: ' . $response);
        }

        return $validatedResponse;
    }

    public function getRunnerAndDownloader(): GithubActionRunStarterAndArtifactDownloader
    {
        return $this->runnerAndDownloader;
    }
}
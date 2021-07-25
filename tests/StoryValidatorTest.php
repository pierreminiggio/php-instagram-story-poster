<?php

namespace PierreMiniggio\InstagramStoryPosterTest;

use PHPUnit\Framework\TestCase;
use PierreMiniggio\InstagramStoryPoster\StoryIdValidator;

class StoryValidatorTest extends TestCase
{
    public function testGoodStoryId(): void
    {
        $validator = new StoryIdValidator();
        self::assertSame(true, $validator->validate('2625167186628519290_6064857443'));
    }

    public function testError(): void
    {
        $validator = new StoryIdValidator();
        self::assertSame(false, $validator->validate('Error while blabla'));
    }
}
<?php

namespace PierreMiniggio\InstagramStoryPosterTest;

use PHPUnit\Framework\TestCase;
use PierreMiniggio\InstagramStoryPoster\StoryIdsValidator;

class StoryValidatorTest extends TestCase
{
    public function testGoodStoryId(): void
    {
        $validator = new StoryIdsValidator();
        self::assertSame([
            '2629555640187552951_48999204161',
            '2629555813965893993_48999204161',
            '2629555970036098817_48999204161'
        ], $validator->validate(
            '["2629555640187552951_48999204161","2629555813965893993_48999204161","2629555970036098817_48999204161"]'
        ));
    }

    public function testError(): void
    {
        $validator = new StoryIdsValidator();
        self::assertSame(false, $validator->validate('Error while blabla'));
    }
}
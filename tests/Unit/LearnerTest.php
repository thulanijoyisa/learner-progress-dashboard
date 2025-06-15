<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\Learner;

class LearnerTest extends TestCase
{
    /**
     * A basic unit test example.
     */
   public function test_full_name_accessor_returns_correct_format()
    {
        $learner = new Learner([
            'firstname' => 'John',
            'lastname' => 'Doe',
        ]);

        $this->assertEquals('John Doe', $learner->full_name);
    }
}

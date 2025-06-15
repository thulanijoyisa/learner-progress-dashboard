<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Learner;
use App\Models\Course;
use App\Models\Enrolment;

class LearnerProgressTest extends TestCase
{
   use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        // Run migrations and seed
        $this->artisan('migrate');
        $this->seed();
    }

    public function test_page_loads_with_learners()
    {
        $response = $this->get('/learner-progress');

        $response->assertStatus(200);
        $response->assertSee('Learner Progress Dashboard');
    }

    public function test_filter_by_course()
    {
        $course = Course::first();
        $response = $this->get('/learner-progress?course=' . urlencode($course->name));

        $response->assertStatus(200);
        $response->assertSee($course->name);
    }

    public function test_sorting_works()
    {
        $response = $this->get('/learner-progress?sort=asc');

        $response->assertStatus(200);
        $response->assertSee('Learner Progress Dashboard');
    }

    public function test_search_works()
    {
        $learner = Learner::factory()->create([
            'firstname' => 'TestFirst',
            'lastname' => 'TestLast',
        ]);

        $response = $this->get('/learner-progress?search=TestFirst');

        $response->assertStatus(200);
        $response->assertSee('TestFirst');
    }
}
<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Payment;
use App\Models\Feedback;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FormateurDashboardTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function only_authenticated_formateur_can_access_dashboard()
    {
        $formateur = User::factory()->create(['role' => 'formateur']);
        $response = $this->actingAs($formateur)->get('/formateur/dashboard');
        $response->assertStatus(200);
        $response->assertSee('Espace Formateur');
    }

    /** @test */
    public function guest_cannot_access_dashboard()
    {
        $response = $this->get('/formateur/dashboard');
        $response->assertRedirect('/login');
    }

    /** @test */
    public function dashboard_displays_courses_and_feedbacks()
    {
        $formateur = User::factory()->create(['role' => 'formateur']);
        $course = Course::factory()->create(['teacher_id' => $formateur->id, 'title' => 'Test Course']);
        $lesson = Lesson::factory()->create(['course_id' => $course->id, 'title' => 'Intro']);
        $payment = Payment::factory()->create(['course_id' => $course->id, 'user_id' => $formateur->id, 'amount' => 100]);
        $feedback = Feedback::factory()->create([
            'course_id' => $course->id,
            'user_id' => $formateur->id,
            'note' => 5,
            'content' => 'Excellent cours !',
            'is_anonymous' => false,
            'is_validated' => true,
        ]);

        $response = $this->actingAs($formateur)->get('/formateur/dashboard');
        $response->assertStatus(200);
        $response->assertSee('Test Course');
        $response->assertSee('Intro');
        $response->assertSee('Excellent cours');
        $response->assertSee('100');
    }
}

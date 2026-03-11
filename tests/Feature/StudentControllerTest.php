<?php

namespace Tests\Feature;

use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StudentControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function index_returns_all_students()
    {
        Student::factory()->count(3)->create();

        $response = $this->getJson('/api/students');

        $response->assertOk()
                 ->assertJsonCount(3);
    }

    /** @test */
    public function store_creates_a_new_student_and_returns_201()
    {
        $payload = [
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'phone' => '555-1234',
            'age' => 20,
        ];

        $response = $this->postJson('/api/students', $payload);

        $response->assertCreated()
                 ->assertJsonFragment(['email' => 'jane@example.com']);

        $this->assertDatabaseHas('students', ['email' => 'jane@example.com']);
    }

    /** @test */
    public function store_returns_validation_errors_for_invalid_input()
    {
        $response = $this->postJson('/api/students', []);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name', 'email', 'age']);
    }

    /** @test */
    public function show_returns_the_specified_student()
    {
        $student = Student::factory()->create();

        $response = $this->getJson("/api/students/{$student->id}");

        $response->assertOk()
                 ->assertJson(["id" => $student->id]);
    }

    /** @test */
    public function update_changes_the_student_and_returns_200()
    {
        $student = Student::factory()->create(['name' => 'Old Name']);

        $payload = ['name' => 'New Name'];

        $response = $this->putJson("/api/students/{$student->id}", $payload);

        $response->assertOk()
                 ->assertJsonFragment(['name' => 'New Name']);

        $this->assertDatabaseHas('students', ['id' => $student->id, 'name' => 'New Name']);
    }

    /** @test */
    public function destroy_deletes_the_student_and_returns_200()
    {
        $student = Student::factory()->create();

        $response = $this->deleteJson("/api/students/{$student->id}");

        $response->assertOk()
                 ->assertJson(['message' => 'Student deleted successfully']);

        $this->assertDatabaseMissing('students', ['id' => $student->id]);
    }
}

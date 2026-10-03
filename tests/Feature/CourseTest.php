<?php

namespace Tests\Feature;

use App\Models\Course;
use App\Models\Instructor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CourseTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_form_returns_validation_errors_and_old_input(): void
    {
        $response = $this->from('/courses/create')->post(route('courses.store'), [
            'code' => ' bad ',
            'title' => '',
            'units' => 9,
        ]);

        $response->assertRedirect('/courses/create')
            ->assertSessionHasErrors(['code', 'title', 'units'])
            ->assertSessionHasInput('code', 'bad');
    }

    public function test_course_can_be_created_with_an_image(): void
    {
        Storage::fake('public');
        $instructor = Instructor::factory()->create();
        $image = UploadedFile::fake()->createWithContent(
            'original.png',
            base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNk+A8AAQUBAScY42YAAAAASUVORK5CYII=')
        );

        $response = $this->post(route('courses.store'), [
            'code' => ' web1 ',
            'title' => 'Web Development',
            'description' => 'Forms and validation',
            'units' => 3,
            'instructor_id' => $instructor->id,
            'is_active' => 1,
            'image' => $image,
        ]);

        $course = Course::firstOrFail();
        $response->assertRedirectToRoute('courses.show', $course)
            ->assertSessionHas('status', 'Course created.');
        $this->assertSame('WEB1', $course->code);
        $this->assertTrue(Storage::disk('public')->exists($course->image_path));
    }

    public function test_update_allows_the_existing_code_and_replaces_the_image(): void
    {
        Storage::fake('public');
        $course = Course::factory()->create(['image_path' => 'courses/old.jpg']);
        Storage::disk('public')->put($course->image_path, 'old');
        $newImage = UploadedFile::fake()->createWithContent(
            'new.png',
            base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNk+A8AAQUBAScY42YAAAAASUVORK5CYII=')
        );

        $response = $this->put(route('courses.update', $course), [
            'code' => $course->code,
            'title' => 'Updated title',
            'units' => 4,
            'is_active' => 0,
            'image' => $newImage,
        ]);

        $course->refresh();
        $response->assertRedirectToRoute('courses.show', $course);
        $this->assertSame('Updated title', $course->title);
        $this->assertFalse($course->is_active);
        $this->assertFalse(Storage::disk('public')->exists('courses/old.jpg'));
        $this->assertTrue(Storage::disk('public')->exists($course->image_path));
    }

    public function test_destroy_deletes_the_course_image(): void
    {
        Storage::fake('public');
        $course = Course::factory()->create(['image_path' => 'courses/remove.jpg']);
        Storage::disk('public')->put($course->image_path, 'image');

        $response = $this->delete(route('courses.destroy', $course));

        $response->assertRedirectToRoute('courses.index')
            ->assertSessionHas('status', 'Course deleted.');
        $this->assertDatabaseMissing('courses', ['id' => $course->id]);
        $this->assertFalse(Storage::disk('public')->exists('courses/remove.jpg'));
    }
}

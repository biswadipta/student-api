<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use Illuminate\Support\Facades\Log; // <-- import Log

class StudentController extends Controller
{
    // GET /api/students
    public function index()
    {
        Log::info('Index method called');
        try {
            $students = Student::all();
            Log::info('Fetched all students successfully', ['count' => $students->count()]);
            return response()->json($students, 200);
        } catch (\Exception $e) {
            // Log the error to storage/logs/laravel.log
            Log::error('Failed to fetch students', ['error' => $e->getMessage()]);
            return response()->json(['message' => 'Something went wrong'], 500);
        }
    }

    public function store(StoreStudentRequest $request)
    {
        $student = Student::create($request->validated());

        return response()->json([
            'message' => 'Student created successfully',
            'data' => $student
        ], 201);
    }

    public function show(Student $student)
    {
        return response()->json($student, 200);
    }

    public function update(UpdateStudentRequest $request, Student $student)
    {
        $student->update($request->validated());

        return response()->json([
            'message' => 'Student updated successfully',
            'data' => $student
        ], 200);
    }

    public function destroy(Student $student)
    {
        $student->delete();

        return response()->json([
            'message' => 'Student deleted successfully'
        ], 200);
    }
}
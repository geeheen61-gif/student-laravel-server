<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class StudentController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Student::all());
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'department' => 'required|string|max:255',
        ]);

        $student = Student::create($data);

        return response()->json($student, 201);
    }

    public function show($id): JsonResponse
    {
        return response()->json(Student::findOrFail($id));
    }

    public function update(Request $request, $id): JsonResponse
    {
        $student = Student::findOrFail($id);

        $data = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:students,email,' . $student->id,
            'department' => 'sometimes|required|string|max:255',
        ]);

        $student->update($data);

        return response()->json($student);
    }

    public function destroy($id): JsonResponse
    {
        Student::destroy($id);

        return response()->json([
            'message' => 'Deleted',
        ]);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StudentSearchRequest;
use App\Http\Resources\StudentResource;
use App\Services\StudentSearchService;

class StudentController extends Controller
{
    public function search(
        StudentSearchRequest $request,
        StudentSearchService $service
    )
    {
        $student = $service->search($request->validated());

        if (! $student) {
            return response()->json([
                'message' => 'لم يتم العثور على الطالب.',
            ], 404);
        }

        return new StudentResource($student);
    }
}

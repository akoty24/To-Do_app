<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Http\Resources\Collection\TaskCollection;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    protected $TaskService;

    public function __construct(TaskService $TaskService)
    {
        $this->TaskService = $TaskService;
    }
    public function index(Request $request)
    {

        $tasks = $this->TaskService->getAll($request);

        if (!$tasks) {
            return response()->json(['message' => 'No tasks found.'], 404);
        }

        return response()->json([

            'tasks' => new TaskCollection($tasks)
        ]);
    }


    public function store(Request $request)
    {
        // Validate incoming request data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'category_id' => 'required|integer',

        ]);

        try {
            // Create a new task using validated data
            $task = Task::create([
                'title' => $validatedData['title'],
                'description' => $validatedData['description'],
                'user_id' => Auth::user()->id,
                'status' => $validatedData['status'],
                'category_id' => $validatedData['category_id'],

            ]);
            // Return a JSON response with the created task and a status code of 201 (Created)
            return response()->json(['task' => $task], 201);
        } catch (\Exception $e) {
            // Log any exceptions for debugging
            Log::error('Error creating task: ' . $e->getMessage());

            // Return a JSON response with an error message and status code
            return response()->json(['error' => 'Failed to create task. Please try again.'], 500);
        }
    }


    public function update(TaskRequest $request, string $id)
    {
        $task = $this->TaskService->update($request->all(), $id);
        $task = new TaskResource(Task::find($id));


        return response()->json([
            'message' => 'task updated successfully.',
            'task' => $task
        ]);
    }

    public function show($id)
    {
        $task = $this->TaskService->getone($id);
        return response()->json(['task' => new TaskResource($task)]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $this->TaskService->delete($id);
            return response()->json(['message' => 'Task deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete task.'], 500);
        }
    }

    public function restore($id)
    {
        $task = $this->TaskService->restore($id);

        return response()->json(['message' => 'task restored successfully.', 'task' => new TaskResource($task)]);
    }
    public function getByCategory(Request $request, $category_id)
    {
        $tasks = $this->TaskService->getByCategory($request, $category_id);

        if (!$tasks) {
            return response()->json(['message' => 'No tasks found.'], 404);
        }
        return response()->json([
            'message' => 'tasks retrieved successfully.',
            'tasks' => new TaskCollection($tasks)
        ]);
    }

    public function updateStatus(Request $request, $id)
    {
        $task = $this->TaskService->updateStatus($id, $request->status);

        if (!$task) {
            return response()->json(['error' => 'Task not found'], 404);
        }

        return response()->json([
            'message' => 'Task updated successfully.',
            'task' => new TaskResource($task)
        ]);
    }
}

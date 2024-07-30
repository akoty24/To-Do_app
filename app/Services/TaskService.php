<?php

namespace App\Services;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class TaskService
{
    public function getAll($request)
    {
        $perPage = $request->per_page ? $request->per_page : 15;
        $tasks = Task::filter($request->all())->orderBy('id', 'asc')->paginate($perPage);

        return $tasks;
    }
    public function getone($id)
    {
        $task = Task::find($id);
        return $task;
    }
    public function getByCategory($request, $category_id)
    {
        if ($request->per_page) {
            $perPage = $request->per_page;
        } else {
            $perPage = 15;
        }

        $tasks = Task::where('category_id', $category_id)->filter($request->all())->orderBy('id', 'asc')->paginate($perPage);

        return $tasks;
    }
    public function restore($id)
    {
        $task = Task::withTrashed()->find($id);
        if (!$task) {
            return response()->json(['message' => 'Failed to restore Task.'], 500);
        }
        $task->restore();
        return $task;
    }

    public function create(array $data)
    {
        $task = Task::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'status' => $data['status'],
            'user_id' => Auth()->id(),
            'category_id' => $data['category_id'],
        ]);
        return $task;
    }

    public function update(array $data, $id)
    {
        $Task = Task::find($id);
        $Task->title = $data['title'];
        $Task->description = $data['description'];
        $Task->status = $data['status'];
        $Task->category_id = $data['category_id'];
        $Task->user_id = Auth()->user()->id;
        $Task->save();
    }

    public function delete($id)
    {
        $Task = Task::find($id);

        $Task->delete();
    }

    public function updateStatus($id, $status)
    {
        $task = Task::find($id);

        if (!$task) {
            return null; // Or handle not found case as needed
        }

        $task->status = $status;
        $task->save();

        return $task;
    }
}

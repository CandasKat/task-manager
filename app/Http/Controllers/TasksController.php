<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $tasks = Task::all();
        return response()->json($tasks);
    }

    public function store(StoreTaskRequest $request): JsonResponse {
        $task = Task::create($request->validated());
        return response()->json($task, 201);


//        $task = new Task();
//        $task->title = $request->title;
//        $task->description = $request->description;
//        $task->assigned_to = $request->assigned_to;
//        $task->due_date = $request->due_date;
//        $task->save();

    }

    public function show($id): JsonResponse {
        $task = Task::findOrFail($id);
        if (!$task) {
            return response()->json(['error' => 'Task not found'], 404);
        }
        return response()->json($task);
    }

    public function update(StoreTaskRequest $request, $id): JsonResponse {
        $task = Task::findOrFail($id);
        $task->update([
            "title" => $request->title,
            "description" => $request->description,
            "assigned_to" => $request->assigned_to,
            "due_date" => $request->due_date
            ]);

        return response()->json($task);


//        $task = Task::find($id);
//        if (!$task) {
//            return response()->json(['error' => 'Task not found'], 404);
//        }
//        $task->title = $request->title;
//        $task->description = $request->description;
//        $task->assigned_to = $request->assigned_to;
//        $task->due_date = $request->due_date;
//        $task->save();

    }

    public function destroy($id) {
        $task = Task::findOrFail($id);
        $task->delete();
        return response()->json(status: 200);


//        $task = Task::find($id);
//        if (!$task) {
//            return response()->json(['error' => 'Task not found'], 404);
//        }
//        Task::destroy($id);
    }
}

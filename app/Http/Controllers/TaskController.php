<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    protected $task;

    public function __construct(Task $task)
    {
        $this->task = $task;
        $this->middleware('api.jwt');
    }

    public function index()
    {
        $date = request()->date ? request()->date : date('Y-m-d 23:59:59');
        $tasks = $this->task->where('estimateAt', '<=', $date)
        ->orderBy('estimateAt')
        ->get();
        return response()->json($tasks, 200);
    }

    public function store(Request $request)
    {
        try {
            $task = $this->task->create($request->all());
            return response()->json($task, 201);
        } catch(\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $this->task->find($id)->update($request->all());
            return response()->json(['message' => 'Task updated successfully'], 200);
        } catch(\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function done($id)
    {
        try {
            $task = $this->task->find($id);
            $task->doneAt = $task->doneAt ? null : date('Y-m-d H:i:s');
            $task->save();
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function destroy($id)
    {
        try {
            $task = $this->task->find($id)->delete();
            return response()->json(['message' => 'Task delete successfully'], 200);
        } catch(\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

}

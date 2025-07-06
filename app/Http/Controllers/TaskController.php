<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function store(StoreTaskRequest $request)
    {
        $task = new Task();
        $task->title = $request->title;
        $task->description = $request->description ?? "";
        $task->status = 'not done';
        $task->task_group_id = $request->task_group_id;
        $task->save();

        return redirect()->route('taskgroup.show', $request->task_group_id);
    }

    public function edit(Task $task)
    {
        $this->authorize('edit', $task);
        return view('task.edit', ['task' => $task]);
    }

    public function update(Request $request, Task $task)
    {
        $this->authorize('edit', $task);
        $task->update([
            'title' => $request->title,
            'description' => $request->description ?? ""
        ]);
        return redirect()->route('taskgroup.show', $task->TaskGroup->id);
    }

    public function updateTaskStatus(Request $request, int $id)
    {
        $task = Task::find($id);
        $this->authorize('edit', $task);
        $task->update(['status' => $request->status]);
        return redirect()->route('taskgroup.show', $task->task_group_id);
    }

    public function destroy(Task $task)
    {
        $taskGroupId = $task->TaskGroup->id;
        $this->authorize('edit', $task);
        $task->delete();
        return redirect()->route('taskgroup.show', $taskGroupId);
    }
}

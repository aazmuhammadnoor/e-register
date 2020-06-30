<?php 

namespace App\Workflow;
use App\Models\Workflow;
use App\Models\Task;

class Step
{
    public static function CekTokenTransition($token)
    {
        $flow = Workflow::where('token', $token)->first();
        return ($flow) ? $flow : false;
    }

    public static function SetTask($workflow_id, $sub_task)
    {
        $is_new_task = Task::where('workflow', $workflow_id)
            ->where('sub_task', $sub_task['sub_task'])
            ->where('event',$sub_task['event'])
            ->first();
        if(is_null($is_new_task)){
            $task = new Task;
            $task->workflow = $workflow_id;
            $task->event = $sub_task['event'];
            $task->sub_task = $sub_task['sub_task'];
            $task->next_task = $sub_task['next_task'];
            $task->executor = $sub_task['executor'];
            $task->save();
        }
    }

    public static function SetLoopTask($workflow_id, $sub_task)
    {
        $task = new Task;
        $task->workflow = $workflow_id;
        $task->event = $sub_task['event'];
        $task->sub_task = $sub_task['sub_task'];
        $task->next_task = $sub_task['next_task'];
        $task->executor = $sub_task['executor'];
        $task->save();
    }
}
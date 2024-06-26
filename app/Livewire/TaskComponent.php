<?php

namespace App\Livewire;

use App\Models\Task;
use Livewire\Component;

class TaskComponent extends Component
{
    public $tasks = [];
    public $title;
    public $description;
    public $id;
    public $miTarea = null;
    public $modal = false;
    public $isUpdating = false;

    public function mount()
    {
        $this->tasks = $this->getTasks()->sortByDesc('id');
    }
    public function getTasks(){
        return Task::where('user_id', auth()->user()->id)->get();
    }

    public function render()
    {
        return view('livewire.task-component');
    }
    private function clearFields(){
        $this->title = '';
        $this->description = '';
        $this->id = '';
        $this->miTarea = null;
        $this->isUpdating = false;
    }
    public function openCreateModal(Task $task = null){
        $this->isUpdating = false;

        if($task){
            // $this->isUpdating = true;
            $this->miTarea = $task;
            $this->title = $task->title;
            $this->description = $task->description;
            $this->id = $task->id;
        }else{
                $this->clearFields();
        }
        $this->modal = true;
    }
    public function closeCreateModal(){
        $this->modal = false;
    }
    public function createorUpdateTask(){

            Task::updateOrCreate(['id' => $this->miTarea->id],
                [

                'title' => $this->title,
                'description' => $this->description,
                'user_id' => auth()->user()->id,
            ]);

        $this->clearFields();
        $this->modal = false;
        $this->tasks = $this->getTasks()->sortByDesc('id');
    }
    public function deleteTask(Task $task){
        $task->delete();
        $this->tasks = $this->getTasks()->sortByDesc('id');
    }


}

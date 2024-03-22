<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Student;
use App\Models\Classes;
use App\Models\Section;
use Livewire\WithPagination;

class ShowStudents extends Component
{
    use WithPagination;
    public $count = 1;
    public function delete($id)
    {
        Student::find($id)->delete();
    }
    public function render()
    {
        $students = Student::orderBy('created_at', 'desc')->simplePaginate(5);
        return view('livewire.show-students', ['students' => $students]);
    }
}

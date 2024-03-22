<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Classes;
use App\Models\Section;
use App\Models\Student;
use Livewire\Attributes\Rule;
use Livewire\WithFileUploads;

class UpdateStudent extends Component
{

    use WithFileUploads;
    public $classes;
    #[Rule('required')]
    public $section;
    #[Rule('required')]
    public $class;
    #[Rule('required|string')]
    public $name;
    #[Rule('required|string|email')]
    public $email;
    #[Rule('image|max:1024|nullable')]
    public $new_image;
    public $image;
    public $student;
    public function mount($id)
    {
        $this->classes = Classes::all();
        $this->student = Student::find($id);
        $this->section = $this->student->section->id;
        $this->class = $this->student->section->class->id;
        $this->name = $this->student->name;
        $this->email = $this->student->email;
        $this->image = $this->student->image;
    }
    public function update()
    {
        $this->validate();
        if (!empty($this->new_image)) {
            $this->image = $this->new_image->store('photos', 'public');
        }
        $this->student->update([
            'name' => $this->name,
            'email' => $this->email,
            'image' => $this->image,
            'class_id' => $this->class,
            'section_id' => $this->section
        ]);
        return $this->redirect('http://localhost/StudentManager/', navigate:true);
    }
    public function render()
    {
        return view('livewire.update-student', [
            'sections' => !empty($this->class) ? Classes::find($this->class)->sections : []
        ]);
    }
}

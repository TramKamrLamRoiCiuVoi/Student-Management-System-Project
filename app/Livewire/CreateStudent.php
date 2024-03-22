<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Classes;
use App\Models\Section;
use App\Models\Student;
use Livewire\Attributes\Rule;
use Livewire\WithFileUploads;
class CreateStudent extends Component
{
    use WithFileUploads;
    public $classes;
    #[Rule('required')] 
    public $section;
    #[Rule('required|string')] 
    public $class;
    #[Rule('required|string')] 
    public $name;
    #[Rule('required|string|email')] 
    public $email;
    #[Rule('image|max:1024')]
    public $image;
    public function mount()
    {
        $this->classes = Classes::all();
        
    }
    public function store(){
        $this->validate();
        $path = $this->image->store('photos','public');
        Student::create([
            'name' => $this->name,
            'email' => $this->email,
            'image' => $path,
            'class_id' => $this->class,
            'section_id' => $this->section
        ]);
        return $this->redirect('http://localhost/StudentManager/', navigate:true);
    }
    public function render()
    {
       
        return view('livewire.create-student',[
            'sections' => !empty($this->class)? Classes::find($this->class)->sections: []
        ]);
    }
}

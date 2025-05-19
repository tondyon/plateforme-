<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Course;

#[\Livewire\Attributes\As('gestion-cours-avance')]
class GestionCoursAvance extends Component
{
    use WithPagination;
    public $search = '';
    public $perPage = 7;
    public $showForm = false;
    public $showEditForm = false;
    public $confirmDeleteId = null;
    public $titre = '';
    public $description = '';
    public $editId = null;

    protected $rules = [
        'titre' => 'required|string|max:255',
        'description' => 'required|string|max:1000',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function showAddForm()
    {
        $this->reset(['titre', 'description', 'editId']);
        $this->showForm = true;
        $this->showEditForm = false;
    }

    public function showEditForm($id)
    {
        $course = Course::findOrFail($id);
        $this->titre = $course->title;
        $this->description = $course->description;
        $this->editId = $id;
        $this->showEditForm = true;
        $this->showForm = false;
    }

    public function saveCourse()
    {
        $this->validate();
        if ($this->editId) {
            $course = Course::findOrFail($this->editId);
            $course->title = $this->titre;
            $course->description = $this->description;
            $course->save();
        } else {
            Course::create([
                'title' => $this->titre,
                'description' => $this->description,
                'teacher_id' => auth()->id(),
            ]);
        }
        $this->reset(['titre', 'description', 'editId', 'showForm', 'showEditForm']);
    }

    public function confirmDelete($id)
    {
        $this->confirmDeleteId = $id;
    }

    public function deleteCourse()
    {
        if ($this->confirmDeleteId) {
            Course::find($this->confirmDeleteId)?->delete();
            $this->confirmDeleteId = null;
        }
    }

    public function render()
    {
        $query = Course::where('teacher_id', auth()->id())
            ->where(function($q) {
                $q->where('title', 'like', '%'.$this->search.'%')
                  ->orWhere('description', 'like', '%'.$this->search.'%');
            });
        $cours = $query->orderByDesc('id')->paginate($this->perPage);
        return view('livewire.gestion-cours-avance', ['cours' => $cours]);
    }
}

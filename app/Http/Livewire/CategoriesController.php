<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;


class CategoriesController extends Component
{

    use WithFileUploads;
    use WithPagination;
    public $name,$search,$image,$selected_id,$pageTitle,$componentName;
    private $pagination = 5;

    public function mount()
    {
        $this->pageTitle = 'Listado';
        $this->componentName = 'Categorias';
    }

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';

    }


    public function render()
    {
        if (strlen($this->search) >0 )
            $data = Category::where('name','like','%'.$this->search.'%')->paginate($this->pagination);
        else
            $data = Category::orderBy('id','desc')->paginate($this->pagination);

        return view('livewire.category.categories', [
            'categories' => $data,
        ])->extends('layouts.theme.app')
            ->section('content');
    }

    public function Edit($id)
    {
        $record = Category::find($id,['id','name','image']);
        $this->name = $record->name;
        $this->selected_id = $record->id;
        $this->image = null;

        $this->emit('show-modal','Show Modal!');
    }

    public function Store()
    {
        $rules = [
            'name'=>'required|unique:categories|min:3',
        ];
        $messages = [
            'name.required' =>'Nombre de la categoria requerido',
            'name.unique'=>'Ya existe la categoria',
            'name.min'=>'El nombre de la categoria debe de tener al menos 3 caracteres'
        ];

        $this->validate($rules,$messages);

        $category = Category::create([
            'name'=>$this->name
        ]);
        $customFileName = '';
        if ($this->image)
        {
            $customFileName = uniqid().'_.'.$this->image->extension();
            $this->image->storeAs('public/categories',$customFileName);
            $category->image = $customFileName;
            $category->save();
        }

        $this->resetUI();
        $this->emit('category-added','Categoria Registrada');

    }

    public function Update()
    {
        $rules = [
            'name'=>"required|min:3|unique:categories,name,{$this->selected_id}",
        ];
        $messages = [
            'name.required' =>'Nombre de la categoria requerido',
            'name.unique'=>'Ya existe la categoria',
            'name.min'=>'El nombre de la categoria debe de tener al menos 3 caracteres'
        ];
        $this->validate($rules,$messages);

        $category = Category::find($this->selected_id);
        $category->update([
            'name' => $this->name
        ]);
        if ($this->image)
        {
            $customFileName = uniqid().'_.'.$this->image->extension();
            $this->image->storeAs('public/categories',$customFileName);

            $imageName = $category->image;
            $category->image = $customFileName;
            $category->save();
            if ($imageName != null){
                if (file_exists('storage/categories'.$imageName))
                {
                    unlink('storage/categories'.$imageName);
                }
            }
        }
        $this->resetUI();
        $this->emit('category-updated','Categoria Actualizada ');
    }

    protected $listeners = [
        'deleteRow'=>'Destroy'
    ];

    public function Destroy($id)
    {
        $category = Category::find($id);
        $imageName = $category->image;
        $category->delete();

        if ($imageName != null){
            unlink('storage/categories/' .$imageName);
        }
        $this->resetUI();
        $this->emit('category-deleted','Categoria Eliminada');
    }

    public function resetUI()
    {
        $this->name='';
        $this->image = null;
        $this->selected_id = 0;
        $this->search = '';

    }
}

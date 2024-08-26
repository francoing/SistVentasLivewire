<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends Component
{
    use WithPagination;
    public $name,$search,$selected_id,$pageTitle,$componentName;
    private $pagination = 5;

    function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }

    function mount()
    {
        $this->pageTitle = 'Listado';
        $this->componentName = 'Roles';
    }

    public function render()
    {
        if (strlen($this->search) > 0)
            $roles = Role::where('name','like','%'.$this->search.'%')->paginate($this->pagination);
        else
            $roles = Role::orderBy('name','asc')->paginate($this->pagination);

        return view('livewire.roles.component',[
            'roles'=>$roles
        ])
            ->extends('layouts.theme.app')
            ->section('content');
    }

    function CreateRole()
    {
        $rules = ['name'=>'required|min:2|unique:roles,name'];

        $message = [
            'name.required'=>'El nombre del role es requerido',
            'name.unique'=>'El rol ya existe',
            'name.min'=>'El nombre del rol debe tener al menos 2 caracteres'
        ];

        $this->validate($rules,$message);

        Role::create(['name'=>$this->name]);

        $this->emit('role-added','Se registro el role con exito');

        $this->resetUI();
    }

    function Edit(Role $role)
    {
        //$role = Role::find($id);
        $this->selected_id = $role->id;
        $this->name = $role->name;

        $this->emit('show-modal','Show Modal');

    }

    function UpdateRole()
    {
        $rules = ['name'=>"required|min:2|unique:roles,name,{$this->selected_id}"];

        $message = [
            'name.required'=>'El nombre del role es requerido',
            'name.unique'=>'El rol ya existe',
            'name.min'=>'El nombre del rol debe tener al menos 2 caracteres'
        ];

        $this->validate($rules,$message);

        $role = Role::find($this->selected_id);
        $role->update([
            'name' => $this->name
        ]);
        $role->save();

        $this->emit('role-updated','Se actualizo el role exito');

        $this->resetUI();
    }

    protected $listeners = [
        'destroy'=>'Destroy'
    ];

    function Destroy($id)
    {
        $permissionsCount = Role::find($id)->permissions->count();

        if ($permissionsCount > 0 )
        {
            $this->emit('role-error','No se puede eliminar el role por que tiene permisos asociados');
            return;
        }

        Role::find($id)->delete();

        $this->emit('role-deleted','Se elimino el role con exito');

    }

    function AsignarRoles($rolesList)
    {
        if ($this->userSelected > 0){
            $user = User::find($this->userSelected);
            if ($user){
                $user->syncRoles($rolesList);
                $this->emit('msg-ok','Roles asignados correctamente');
                $this->resetInput();
            }
        }
    }

    function resetUI()
    {
       $this->name = '';
       $this->search = '';
       $this->selected_id = 0;
       $this->resetValidation();

    }
}

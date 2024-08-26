<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class PermisosController extends Component
{
    use WithPagination;
    public $permissionName,$search,$selected_id,$pageTitle,$componentName;
    private $pagination = 10;

    function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }

    function mount()
    {
        $this->pageTitle = 'Listado';
        $this->componentName = 'Permisos';
    }

    public function render()
    {
        if (strlen($this->search) > 0)
            $permisos = Permission::where('name','like','%'.$this->search.'%')->paginate($this->pagination);
        else
            $permisos = Permission::orderBy('name','asc')->paginate($this->pagination);

        return view('livewire.permisos.component',[
            'permisos'=>$permisos
        ])
            ->extends('layouts.theme.app')
            ->section('content');
    }

    function CreatePermission()
    {
        $rules = ['permissionName'=>'required|min:2|unique:permissions,name'];

        $message = [
            'permissionName.required'=>'El nombre del permiso es requerido',
            'permissionName.unique'=>'El permiso ya existe',
            'permissionName.min'=>'El nombre del permiso debe tener al menos 2 caracteres'
        ];

        $this->validate($rules,$message);

        Permission::create(['name'=>$this->permissionName]);

        $this->emit('permiso-added','Se registro el role con exito');

        $this->resetUI();
    }

    function Edit(Permission $permiso)
    {

        $this->selected_id = $permiso->id;
        $this->permissionName = $permiso->name;

        $this->emit('show-modal','Show Modal');

    }

    function UpdatePermission()
    {
        $rules = ['permissionName'=>"required|min:2|unique:permissions,name,{$this->selected_id}"];

        $message = [
            'permissionName.required'=>'El nombre del permiso es requerido',
            'permissionName.unique'=>'El permiso ya existe',
            'permissionName.min'=>'El nombre del permiso debe tener al menos 2 caracteres'
        ];

        $this->validate($rules,$message);

        $permiso = Permission::find($this->selected_id);
        $permiso->update([
            'name' => $this->permissionName
        ]);
        $permiso->save();

        $this->emit('permiso-updated','Se actualizo el permiso con exito');

        $this->resetUI();
    }

    protected $listeners = [
        'destroy'=>'Destroy'
    ];

    function Destroy($id)
    {
        $rolesCount = Permission::find($id)->getRoleNames()->count();

        if ($rolesCount > 0 )
        {
            $this->emit('permiso-error','No se puede eliminar el permiso por que tiene roles asociados');
            return;
        }

        Permission::find($id)->delete();

        $this->emit('permiso-deleted','Se elimino el permiso con exito');

    }

    function AsignarPermissions($permisosList)
    {
        if ($this->userSelected > 0){
            $user = User::find($this->userSelected);
            if ($user){
                $user->syncPermissions($permisosList);
                $this->emit('msg-ok','Permissions asignados correctamente');
                $this->resetInput();
            }
        }
    }

    function resetUI()
    {
        $this->permissionName = '';
        $this->search = '';
        $this->selected_id = 0;
        $this->resetValidation();

    }
}

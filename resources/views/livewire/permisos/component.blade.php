
<div class="row sales layout-top-spacing">
    <div class="col-sm-12">
        <div class="widget widget-card-one">
            <div class="widget-heading">
                <h4 class="card-title">
                    <b>{{$componentName}} | {{$pageTitle}}</b>
                </h4>
                <ul class="tabs tab-pills">
                    <li>
                        <a href="javascript:void(0)" class="tabmenu bg-dark" data-toggle="modal" data-target ="#theModal">
                            Agregar
                        </a>
                    </li>
                </ul>
            </div>
            @include('common.searchbox')

            <div class="widget-content">

                <div class="table-responsive">
                    <table class="table table-bordered table striped mt-1">
                        <thead class="text-white" style="background: #3b3f5c">
                        <tr>
                            <th class="table-th text-white">ID</th>
                            <th class="table-th text-white text-center">Descripcion</th>
                            <th class="table-th text-white text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($permisos as $permiso)
                            <tr>
                                <td><h6{{$permiso->id}}</h6></td>
                                <td class="text-center">
                                    <h6>{{$permiso->name}}</h6>
                                </td>
                                <td class="text-center">
                                    <a href="javascript:void(0)"
                                       wire:click="Edit({{$permiso->id}})"
                                       class="btn btn-dark mtmobile"
                                       title="Editar">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>
                                    </a>
                                    <a href="javascript:void(0)"
                                       onclick="Confirm('{{$permiso->id}}')"
                                       class="btn btn-dark "
                                       title="Borrar">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{$permisos->links()}}
                </div>

            </div>

        </div>

    </div>

    @include('livewire.permisos.form')
</div>

<script>
    document.addEventListener('DOMContentLoaded',function () {

        window.livewire.on('permiso-added',Msg=>{
            $('#theModal').modal('hide')
            noty(Msg)
        })
        window.livewire.on('permiso-updated',Msg=>{
            $('#theModal').modal('hide')
            noty(Msg)
        })
        window.livewire.on('permiso-deleted',Msg=>{

            noty(Msg)
        })
        window.livewire.on('permiso-exists',Msg=>{

            noty(Msg)
        })
        window.livewire.on('permiso-error',Msg=>{
            noty(Msg)
        })
        window.livewire.on('hide-modal',Msg=>{
            $('#theModal').modal('hide')
        })
        window.livewire.on('show-modal',Msg=>{
            $('#theModal').modal('show')
        })


    })

    function Confirm(id){
        swal({
            title:'CONFIRMAR',
            text:'¿Confirmas Eliminar el registro?',
            type:'warning',
            showCancelButton:true,
            cancelButtonText: 'Cerrar',
            cancelButtonColor:'#fff',
            confirmButtonColor:'#3b3f5c',
            confirmButtonText:'Aceptar',
        }).then(function (result){
            if (result.value){
                window.livewire.emit('destroy',id)
                swal.close()
            }
        })
    }
</script>

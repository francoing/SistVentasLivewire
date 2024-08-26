

<div class="row sales layout-top-spacing">
    <div class="col-sm-12">
        <div class="widget widget-card-one">
            <div class="widget-heading">
                <h4 class="card-title">
                    <b>{{$componentName}} | {{$pageTitle}}</b>
                </h4>
                <ul class="tabs tab-pills">

                    @can('Category_create')
                        <a href="javascript:void(0)" type="button" class="tabmenu bg-dark" data-toggle="modal" data-target ="#theModal">
                            Agregar
                        </a>
                    @endcan
                </ul>
            </div>
            @can('Category_search')
                @include('common.searchbox')
            @endcan
            <div class="widget-content">

                <div class="table-responsive">
                    <table class="table table-bordered table striped mt-1">
                        <thead class="text-white" style="background: #3b3f5c">
                        <tr>
                            <th class="table-th text-white">Descripcion</th>
                            <th class="table-th text-white">Imagen</th>
                            <th class="table-th text-white">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td><h6>{{$category->name}}</h6></td>
                                <td class="text-center">
                                        <span>
                                        <img src="{{asset('storage/categories/'.$category->imagen)}}" alt="imagen de ejemplo"height="70" width="80" class="rounded">
                                        </span>
                                </td>
                                <td class="text-center">
                                    @can('Category_edit')
                                        <a href="javascript:void(0)" class="btn btn-dark mtmobile" title="Editar"
                                        wire:click="Edit({{$category->id}})">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>
                                        </a>
                                    @endcan

                                    @if($category->products->count() > 1 )
                                        @can('Category_destroy')
                                            <a href="javascript:void(0)" class="btn btn-dark " title="Borrar"
                                               onclick="Confirm('{{$category->id}}')">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        @endcan
                                    @endif

                                </td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                    {{$categories->links()}}
                </div>

            </div>

        </div>

    </div>

    @include('livewire.category.form')
</div>

<script>
    document.addEventListener('DOMContentLoaded',function () {
        window.livewire.on('show-modal',msg=>{
            $('#theModal').modal('show');
        })
        window.livewire.on('category-added',msg=>{
            $('#theModal').modal('hide');
        })
        window.livewire.on('category-updated',msg=>{
            $('#theModal').modal('hide');
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
                window.livewire.emit('deleteRow',id)
                swal.close()
            }
        })
    }

</script>


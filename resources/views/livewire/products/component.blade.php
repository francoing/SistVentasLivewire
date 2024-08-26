
<div class="row sales layout-top-spacing">
    <div class="col-sm-12">
        <div class="widget widget-card-one">
            <div class="widget-heading">
                <h4 class="card-title">
                    <b>{{$componentName}} |{{$pageTitle}}</b>
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
                            <th class="table-th text-white">Descripcion</th>
                            <th class="table-th text-white text-center">Barcode</th>
                            <th class="table-th text-white text-center">Categoria</th>
                            <th class="table-th text-white text-center">Precio</th>
                            <th class="table-th text-white text-center">Stock</th>
                            <th class="table-th text-white text-center">Inv. Min</th>
                            <th class="table-th text-white text-center">Imagen</th>
                            <th class="table-th text-white text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $product)
                                <tr>
                                    <td><h6 class="text-left">{{$product->name}}</h6></td>
                                    <td><h6 class="text-center">{{$product->barcode}}</h6></td>
                                    <td><h6 class="text-center">{{$product->category_id}}</h6></td>
                                    <td><h6 class="text-center">{{$product->price}}</h6></td>
                                    <td><h6 class="text-center">{{$product->stock}}</h6></td>
                                    <td><h6 class="text-center">{{$product->alerts}}</h6></td>
                                    <td class="text-center">
                                        <span>
                                        <img src="{{asset('storage/products/'.$product->imagen)}}" alt="imagen de ejemplo"height="70" width="80" class="rounded">
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <a href="javascript:void(0)"
                                           class="btn btn-dark mtmobile"
                                           wire:click.prevent="Edit({{$product->id}})"
                                           title="Editar">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>
                                        </a>
                                        <a href="javascript:void(0)"
                                           onclick="Confirm('{{$product->id}}')"
                                           class="btn btn-dark "
                                           title="Borrar">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-toggle-right"><rect x="1" y="5" width="22" height="14" rx="7" ry="7"></rect><circle cx="16" cy="12" r="3"></circle></svg>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$data->links()}}
                </div>

            </div>

        </div>

    </div>

    @include('livewire.products.form')
</div>

<script>
    document.addEventListener('DOMContentLoaded',function () {


        window.livewire.on('product-deleted',msg=>{

        })
        window.livewire.on('product-added',msg=>{
            $('#theModal').modal('hide');
        })
        window.livewire.on('product-updated',msg=>{
            $('#theModal').modal('hide');
        })
        window.livewire.on('modal-show',msg=>{
            $('#theModal').modal('show');
        })
        window.livewire.on('modal-hide',msg=>{
            $('#theModal').modal('hide');
        })
        window.livewire.on('hidden.bs.modal',msg=>{
            $('.er').css('display','none')

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

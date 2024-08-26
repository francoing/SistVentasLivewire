

<div class="row sales layout-top-spacing">
    <div class="col-sm-12">
        <div class="widget widget-card-one">
            <div class="widget-heading">
                <h4 class="card-title">
                    <b>{{$componentName}} | {{$pageTitle}}</b>
                </h4>
                <ul class="tabs tab-pills">

                    <a href="javascript:void(0)" type="button" class="tabmenu bg-dark" data-toggle="modal" data-target ="#theModal">
                        Agregar
                    </a>
                </ul>
            </div>
            @include('common.searchbox')

            <div class="widget-content">

                <div class="table-responsive">
                    <table class="table table-bordered table striped mt-1">
                        <thead class="text-white" style="background: #3b3f5c">
                        <tr>
                            <th class="table-th text-white">Tipo</th>
                            <th class="table-th text-white text-center" >Valor</th>
                            <th class="table-th text-white text-center">Imagen</th>
                            <th class="table-th text-white text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $coin)
                            <tr>
                                <td><h6>{{$coin->type}}</h6></td>
                                <td><h6 class="text-center">${{number_format($coin->value , 2)}}</h6></td>
                                <td class="text-center">
                                        <span>
                                        <img src="{{asset('storage/'.$coin->imagen)}}" alt="imagen de ejemplo" height="70" width="80" class="rounded">
                                        </span>
                                </td>
                                <td class="text-center">
                                    <a href="javascript:void(0)" class="btn btn-dark mtmobile" title="Editar"
                                       wire:click="Edit({{$coin->id}})">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>
                                    </a>
                                    <a href="javascript:void(0)" class="btn btn-dark " title="Borrar"
                                       onclick="Confirm('{{$coin->id}}')">
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

    @include('livewire.denomination.form')
</div>

<script>
    document.addEventListener('DOMContentLoaded',function () {


        window.livewire.on('item-deleted',msg=>{

        })
        window.livewire.on('item-added',msg=>{
            $('#theModal').modal('hide');
        })
        window.livewire.on('item-updated',msg=>{
            $('#theModal').modal('hide');
        })
        window.livewire.on('show-modal',msg=>{
            $('#theModal').modal('show');
        })
        window.livewire.on('modal-hide',msg=>{
            $('#theModal').modal('hide');
        })
        $('#theModal').on('hidden.bs.modal',function(){
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


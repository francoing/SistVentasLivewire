<div wire:ignore.self class="modal fade" tabindex="-1" role="dialog" id="modalDetails">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title text-white">
                    <b>Detalle de venta # {{$saleId}}</b>
                </h5>
                <h6 class="text-center text-warning" wire:loading>
                    POR FAVOR ESPERE
                </h6>
            </div>
            <div class="modal-body">

                <div class="table-responsive">
                    <table class="table table-bordered table striped mt-1">
                        <thead class="text-white" style="background: #3b3f5c">
                        <tr>
                            <th class="table-th text-white text-center">Folio</th>
                            <th class="table-th text-white text-center">Producto</th>
                            <th class="table-th text-white text-center">Precio</th>
                            <th class="table-th text-white text-center">Cant</th>
                            <th class="table-th text-white text-center">Importe</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($details as $d)


                        <tr>
                            <td><h6>{{$d->id}}</h6></td>
                            <td><h6>{{$d->product}}</h6></td>
                            <td class="table-th text-white text-center"><h6>{{number_format($d->price,2)}}</h6></td>
                            <td class="table-th text-white text-center"><h6>{{number_format($d->quantity,0)}}</h6></td>
                            <td class="table-th text-white text-center"><h6>{{number_format($d->price * $d->quantity,2)}}</h6></td>

                        </tr>
                        @endforeach
                        </tbody>

                        <tfoot>
                        <tr>
                            <td colspan="3"><h5 class="text-center font-weight-bold">Totales</h5> </td>
                            <td ><h5 class="text-center">{{$countDetails}}</h5></td>
                            <td>
                                <h5 class="text-center">
                                    {{number_format($sumDetails,2)}}
                                </h5>
                            </td>

                        </tr>
                        </tfoot>
                    </table>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark close-btn text-info" data-dismiss="modal">CERRAR</button>
            </div>
        </div>
    </div>
</div>

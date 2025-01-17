<div class="modal fade" wire:ignore.self id="modal-detail" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title text-white">
                    <b>Detalle de ventas</b>
                </h5>
                <button class="close" data-dismiss="modal" type="button" aria-label="close">
                    <span class="text-white">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="table-responsive">
                    <table class="table table-bordered table-striped mt-1">
                        <thead class="text-white" style="background: #3b3ff5">
                            <tr>
                                <th class="table-th text-center text-white">Producto</th>
                                <th class="table-th text-center text-white">Cant</th>
                                <th class="table-th text-center text-white">Precio</th>
                                <th class="table-th text-center text-white">Importe</th>
                            </tr>
                        </thead>

                        <tbody >
                        @foreach($details as $d)
                            <tr>
                                <td class="text-center"><h6>{{$d->product}}</h6></td>
                                <td class="text-center"><h6>{{$d->quantity}}</h6></td>
                                <td class="text-center"><h6> ${{number_format($d->price,2)}}</h6></td>
                                <td class="text-center"><h6>{{number_format($d->quantity * $d->price , 2)}}</h6></td>

                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                                <td class="text-right">
                                    <h6 class="text-info">Totales:</h6>
                                </td>

                                <td class="text-center">
                                    @if($details)
                                        <h6 class="text-info">{{$details->sum('quantity')}}</h6>
                                    @endif
                                </td>
                                @if($details)
                                   @php
                                    $myTotal = 0;
                                   @endphp
                                    @foreach($details as $d)
                                        @php
                                        $myTotal += $d->quantity * $d->price
                                        @endphp
                                    @endforeach
                                    <td></td>
                                    <td class="text-center"><h6 class="text-info"> ${{number_format($myTotal,2)}}</h6></td>
                                @endif
                        </tfoot>
                    </table>
                </div>

            </div>

        </div>
    </div>
</div>

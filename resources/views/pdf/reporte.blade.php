<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de Ventas</title>

    <link rel="stylesheet" href="{{asset('css/custom_pdf.css')}}">
    <link rel="stylesheet" href="{{asset('css/custom_page.css')}}">

</head>
<body>

    <section class="header" style="top:-287px;">
        <table cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <td colspan="2" class="text-center">
                    <span style="font-size: 25px; font-weight: bold;">Sistem LWPOS</span>
                </td>
            </tr>
            <tr>
                <td width="30%" style="vertical-align: top; padding-top:10px; position: relative;">
                    <img src="{{asset('assets/img/bg.png')}}" alt="" class="invoice.logo">
                </td>
                <td width="70%" class="text-left text-company" style="vertical-align: top;padding-top: 10px">
                    @if($reportType == 0)
                        <span style="font-size: 16px"><strong>Reporte de ventas del Dia</strong></span>
                    @else
                        <span style="font-size: 16px"><strong>Reporte de ventas por Fechas</strong></span>
                    @endif
                    <br>
                    @if($reportType != 0 )
                        <span style="font-size: 16px"><strong>Fecha de consulta:{{$dateFrom}} as {{$dateTo}}</strong></span>
                    @else
                        <span style="font-size: 16px"><strong>Fecha de consulta:{{\Carbon\Carbon::now()->format('d-M-Y')}} </strong></span>
                    @endif
                    <br>
                    <span style="font-size: 14px">Usuario :{{$user}}</span>
                </td>
            </tr>
        </table>
    </section>

    <section style="margin-top: -110px">
        <table cellpadding="0" cellspacing="0" class="table-items" width="100%">
            <thead>
                <tr>
                    <td width="10%">Folio</td>
                    <td width="12%">Importe</td>
                    <td width="10%">Items</td>
                    <td width="12%">Estatus</td>
                    <td width="">Usuario</td>
                    <td width="18%">Fecha</td>
                </tr>
            </thead>

            <tbody>
                @foreach($data as $item)
                    <tr>
                        <td align="center">{{$item->id}}</td>
                        <td align="center">{{ number_format($item->total,2)}}</td>
                        <td align="center">{{$item->items}}</td>
                        <td align="center">{{$item->status}}</td>
                        <td align="center">{{$item->user}}</td>
                        <td align="center">{{$item->created_at}}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
            <tr>
                <td class="text-center">
                    <span><b>Totales</b></span>
                </td>
                <td class="text-center">
                    <span><strong>${{number_format($data->sum('total'),2)}}</strong></span>
                </td>
                <td class="text-center">
                    <span>{{$data->sum('item'),2}}</strong></span>
                </td>
                <td colspan="3"></td>
            </tr>
            </tfoot>
        </table>
    </section>

    <section class="footer">
        <table cellpadding="0" cellspacing="0" class="table-items" width="100%">
            <tr>
                <td width="20%">
                    <span>Sistema LWPOS V1</span>
                </td>
                <td width="60%" class="text-center">
                    F. Montti
                </td>
                <td width="20%" class="text-center">
                   pagina<span class="pagenum"><span>
                </td>
            </tr>
        </table>

    </section>


</body>
</html>

<?php

namespace App\Http\Livewire;

use App\Models\Denomination;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleDetails;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class PosController extends Component
{
    public $total ,$itemsQuantity , $efectivo ,$change;

    function mount()
    {
        $this->efectivo = 0;
        $this->change = 0;
        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();
    }

    public function render()
    {
        return view('livewire.pos.component',[
            'denominations' => Denomination::orderBy('value','desc')->get(),
            'cart'=>Cart::getContent()->sortBy('name')
            ])
            ->extends('layouts.theme.app')
            ->section('content');
    }

    public function ACash($value)
    {
        $this->efectivo +=($value ==0 ? $this->total : $value);
        $this->change = ($this->efectivo - $this->total);

    }

    protected $listeners = [
        'scan-code'=>'ScanCode',
        'removeItem' =>'removeItem',
        'clearCart'=>'clearCart',
        'saveSale'=>'saveSale'
    ];

    function ScanCode($barcode, $cant = 1)
    {
        //dd($barcode);
        $product = Product::where('barcode',$barcode)->first();

        if ($product == null || empty($product)){
            $this->emit('scan-notfound','El producto no fue encontrado');
        }else{
            if ($this->InCart($product->id)){
                $this->increaseQty($product->id);
                    return;
            }

            if ($product->stock <1 ){
                $this->emit('no-stock','stock insuficiente');
                return;
            }

            Cart::add($product->id,$product->name,$product->price,$cant,$product->image);
            $this->total = Cart::getTotal();

            $this->emit('scan-ok','Producto agregado');

        }
    }

    function InCart($productId)
    {

        $exist = Cart::get($productId);

        if ($exist)
            return true;
        else
            return false;
    }

    function increaseQty($productId, $cant = 1)
    {
        $title = '';
        $product = Product::find($productId);
        $exist = Cart::get($productId);

        if($exist)
            $title = 'Cantidad actualizada';
        else
            $title = 'Producto agregado';

        if ($exist)
        {
            if ($product->stock < ($cant + $exist->quantity)){
                $this->emit('no-stock','Stock insuficiente');
                return;
            }
        }

        Cart::add($product->id,$product->name,$product->price,$cant,$product->image);

        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();

        $this->emit('scan-ok',$title);

    }

    function updateQty($productId, $cant = 1)
    {
        $title = '';
        $product = Product::find($productId);
        $exist = Cart::get($productId);

        if($exist)
            $title = 'Cantidad actualizada';
        else
            $title = 'Producto agregado';

        if ($exist){
            if ($product->stock < $cant){
                $this->emit('no-stock','Stock insuficiente');
                return;
            }
        }

        $this->removeItem($productId);

        if ($cant > 0)
        {
            Cart::add($product->id,$product->name,$product->price,$cant,$product->image);
            $this->total = Cart::getTotal();
            $this->itemsQuantity = Cart::getTotalQuantity();

            $this->emit('scan-ok',$title);
        }

    }

    function removeItem($productId)
    {

        Cart::remove($productId);
        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();

        $this->emit('scan-ok', ' Producto Eliminado');
    }

    function decreaseQty($productId)
    {
        $item = Cart::get($productId);
        Cart::remove($productId);

        $newQty = ($item->quantity)-1;

        if ($newQty > 0 ){
            Cart::add($item->id,$item->name,$item->price,$newQty,$item->attributes[0]);
        }

        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();

        $this->emit('scan-ok','Cantidad Actualizada');

    }

    function clearCart()
    {
        Cart::clear();
        $this->efectivo = 0;
        $this->change = 0;

        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();

        $this->emit('scan-ok', ' Carrito vacio');
    }

    function saveSale()
    {
        if ($this->total <= 0){

            $this->emit('sale-error','Agrega Productos a la venta');
            return;
        }

        if ($this->efectivo <= 0){

            $this->emit('sale-error','Ingrese el efectivo');
            return;
        }

        if ($this->total > $this->efectivo){

            $this->emit('sale-error','El efectivo debe ser mayor o igual al total');
            return;
        }

        DB::beginTransaction();

        try {
            $sale = Sale::create([
                'total'=>$this->total,
                'items'=>$this->itemsQuantity,
                'cash'=>$this->efectivo,
                'change'=>$this->change,
                'user_id'=>Auth::user()->id,
            ]);

            if ($sale){
                $items = Cart::getContent();

                foreach ($items as $item){
                    SaleDetails::create([
                        'price'=>$item->price,
                        'quantity'=>$item->quantity,
                        'product_id'=>$item->id,
                        'sale_id' => $sale->id
                    ]);

                    $product = Product::find($item->id);
                    $product->stock =  $product->stock - $item->quantity;
                    $product->save();

                }
            }

            DB::commit();

            Cart::clear();
            $this->efectivo = 0;
            $this->change = 0;
            $this->total = Cart::getTotal();
            $this->itemsQuantity = Cart::getTotalQuantity();
            $this->emit('sale-ok','Venta registrada con exito');
            $this->emit('print-ticket',$sale->id);

        }catch (Exception $e){
            DB::rollBack();
            $this->emit('sale-error',$e->getMessage());
        }


    }

    // update change when keyboard typing
    public function updatedEfectivo($value)
    {
        $efectivoZero = ($value === '' ? 0 : $value);
        $this->change = ($efectivoZero - $this->total);
    }

    function printTicket($sale){
        return Redirect::to("print://$sale->id");
    }


}

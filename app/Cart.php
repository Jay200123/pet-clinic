<?php
namespace App;
use Session;
class Cart{
public $service = null;
public $totalQty = 0;
public $totalPrice = 0;
            
public function __construct($oldCart) {
     if($oldCart) {
    $this->service = $oldCart->service;
    $this->totalQty = $oldCart->totalQty;
   $this->totalPrice = $oldCart->totalPrice;
}
}

public function add($service, $id){

$storedItem = ['qty'=>0, 'price'=>$service->service_cost, 'service'=> $service];
if ($this->service){
if (array_key_exists($id, $this->service)){
                    $storedItem = $this->service[$id];
}

}

$storedItem['qty']++;
$storedItem['price'] = $service->sell_price * $storedItem['qty'];
$this->service[$id] = $storedItem;
$this->totalQty++;
$this->totalPrice += $service->service_cost;
}

public function reduceByOne($id){
$this->service[$id]['qty']--;
$this->service[$id]['price']-= $this->service[$id]['service']['service_cost'];
$this->totalQty --;
$this->totalPrice -= $this->service[$id]['service']['service_cost'];
if ($this->service[$id]['qty'] <= 0) {
            unset($this->service[$id]);
}

}

public function removeItem($id){
$this->totalQty -= $this->service[$id]['qty'];
$this->totalPrice -= $this->service[$id]['price'];
unset($this->service[$id]);
}

}
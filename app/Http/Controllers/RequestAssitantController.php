<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RequestAssistant;


class RequestAssitantController extends Controller
{
	/**
     * Provide class
     */
	private $provider=Visit::class;

    /**
     * Web RoutePath for the name of the routes
     */
    private $webroute_path="admin.restaurant.assistant.";

    /**
     * View path
     */
    private $view_path="assistant.";

     /**
     * Parameter name
     */
     private $parameter_name="assistant";

    /**
     * Title of this crud
     */
    private $title="customer assistant";

    /**
     * Title of this crud in plural
     */
    private $titlePlural="customers assistant";

    /**
     * Auth checker functin for the crud
     */
    private function authChecker(){
    	$this->ownerOnly();
    }
    private function getFields($class="col-md-6",$restaurant=null){
        if($restaurant==null){
            $restaurant=$this->getRestaurant();
        }
        return [
           ['class'=>$class, 'ftype'=>'input','name'=>"chat_id",'id'=>"chat_id",'required'=>true,'placeholder'=>__('chat_id')],
           ['class'=>$class, 'ftype'=>'input','name'=>"request_message",'id'=>"request_message",'required'=>true,'placeholder'=>__('chat_id')],
           ['class'=>$class, 'ftype'=>'input','name'=>"requested_to",'id'=>"requested_to",'required'=>true,'placeholder'=>__('requested_to')],
           ['class'=>$class, 'ftype'=>'input','name'=>"requested_time",'id'=>"requested_time",'required'=>true,'placeholder'=>__('requested_time')],
           ['class'=>$class, 'ftype'=>'input','name'=>"response_message",'id'=>"response_message",'required'=>true,'placeholder'=>__('response_message')],
           ['class'=>$class, 'ftype'=>'input','name'=>"restaurant",'id'=>"restaurant",'required'=>true,'placeholder'=>__('restaurant')]
       ];
   }
    public function getAllChat(RequestAssistant $items)
    {
    	$class="col-md-4";
    	$fields=$this->getFields($class);
    	//dd($fields);
    	$items = $items->orderBy('id','DESC')->paginate(env('PAGINATE',10));
    	return view($this->view_path.'index', ['setup' => [
    		'title'=>__('crud.item_managment',['item'=>__($this->titlePlural)]),
    		'action_name'=>__('crud.add_new_item',['item'=>__($this->title)]),
    		'items'=>$items,
    		'item_names'=>$this->titlePlural,
    		'webroute_path'=>$this->webroute_path,
    		'fields'=>$fields,
    		'parameter_name'=>$this->parameter_name,
    		'parameters'=>count($_GET)!=0,
    		'action' => false
    	]]);
    } 
    public function edit()
    {
    	echo ''; exit;
    }
}

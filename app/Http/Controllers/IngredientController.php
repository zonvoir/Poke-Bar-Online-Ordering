<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ingredients;


class IngredientController extends Controller
{
	/**
     * Provide class
     */
    private $provider=Ingredients::class;

    /**
     * View path
     */
    private $view_path="ingredients.";

    /**
     * Auth checker functin for the crud
     */
    private function authChecker(){
        $this->ownerOnly();
    }
    /**
     * Title of this crud
     */
    private $title="ingredient";
    /**
     * Title of this crud in plural
     */
    private $titlePlural="ingredients";
    /**
     * Web RoutePath for the name of the routes
     */
    private $webroute_path="ingredients.";

	private function getFields(){
        return [
            ['class'=>"col-md-4", 'ftype'=>'input','name'=>"Name",'id'=>"name",'placeholder'=>"Enter ingredient name",'required'=>true],
        ];
    }
    /**
     * Parameter name
     */
    private $parameter_name="ingredient";

    public function index()
    {
    	//dd(Ingredients::paginate(env('PAGINATE',10)));
    	$this->authChecker();
        return view($this->view_path.'index', ['setup' => [
            'title'=>__('crud.item_managment',['item'=>__($this->titlePlural)]),
            'action_link'=>route($this->webroute_path.'create'),
            'action_name'=>__('Add new ingredient',['ingredient'=>__($this->title)]),
            'action_link2'=>route($this->webroute_path.'index'),
            'action_name2'=>__("All Ingredients"),
            'items'=>Ingredients::paginate(env('PAGINATE',10)),
            'item_names'=>$this->titlePlural,
            'webroute_path'=>$this->webroute_path,
            'fields'=>$this->getFields(),
            'parameter_name'=>$this->parameter_name,
        ]]);
            
    }
    public function create()
    {
    	$this->authChecker();
        return view('general.form', ['setup' => [
            'inrow'=>true,
            'title'=>__('New ingredient',['item'=>__($this->title)]),
            'action_link'=>route($this->webroute_path.'index'),
            'action_name'=>__("crud.back"),
            'iscontent'=>true,
            'action'=>route($this->webroute_path.'store'),
        ],
        'fields'=>$this->getFields()]);
    }
    public function store(Request $request)
    {
    	$this->authChecker();
        $this->provider::create([
            'name'=>$request->name,
        ]);
        return redirect()->route($this->webroute_path.'index')->withStatus(__('Ingredients added',['item'=>__($this->title)]));
    }
    public function edit($id)
    {

        $this->authChecker();
        $item=$this->provider::findOrFail($id);
        $fields=$this->getFields();
        $fields[0]['value']=$item->name;
        $parameter=[];
        $parameter[$this->parameter_name]=$id;
        return view('general.form', ['setup' => [
            'inrow'=>true,
            'title'=>__('Edit Ingredient',['item'=>__($this->title),'name'=>$item->name]),
            'action_link'=>route($this->webroute_path.'index'),
            'action_name'=>__("crud.back"),
            'iscontent'=>true,
            'isupdate'=>true,
            'action'=>route($this->webroute_path.'update',$parameter),
        ],
        'fields'=>$fields]);
    }
    public function update(Request $request,  $id)
    {
        $this->authChecker();
        $item=$this->provider::findOrFail($id);
        $item->name=$request->name;
        $item->update();
        return redirect()->route($this->webroute_path.'index')->withStatus(__('Ingredient has been updated!',['item'=>__($this->title)]));
    }
    public function destroy($id)
    {
        $this->authChecker();
        $item=$this->provider::findOrFail($id);
        $item->delete();

        //TODO -- Delete customers from this table
        return redirect()->route($this->webroute_path.'index')->withStatus(__('Ingredient has been removed!',['item'=>__($this->title)]));  
    }
}

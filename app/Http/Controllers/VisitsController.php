<?php

namespace App\Http\Controllers;

use App\Visit;
use App\Tables;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Restorant;

use App\Exports\VisitsExport;
use Maatwebsite\Excel\Facades\Excel;

class VisitsController extends Controller
{


    /**
     * Provide class
     */
    private $provider=Visit::class;

    /**
     * Web RoutePath for the name of the routes
     */
    private $webroute_path="admin.restaurant.visits.";

    /**
     * View path
     */
    private $view_path="visits.";

     /**
     * Parameter name
     */
     private $parameter_name="visit";

    /**
     * Title of this crud
     */
    private $title="customer visit";

    /**
     * Title of this crud in plural
     */
    private $titlePlural="customers visits";

    /**
     * Auth checker functin for the crud
     */
    private function authChecker(){
        $this->ownerOnly();
    }


    /**
     * List of fields for edit and create
     */
    private function getFields($class="col-md-6",$restaurant=null){
        if($restaurant==null){
            $restaurant=$this->getRestaurant();
        }

        $tables=Tables::where('restaurant_id',$restaurant->id)->get();
        $tablesData=[];
        foreach ($tables as $key => $table) {
            $tablesData[$table->id]=$table->restoarea?$table->restoarea->name." - ".$table->name:$table->name;
        }
        return [
           ['class'=>$class, 'ftype'=>'input','name'=>"customers.entry_time",'id'=>"entry_time",'placeholder'=>__('Time of entry'), 'required'=>true, 'value' =>  Carbon::now()->toDayDateTimeString()],
           ['class'=>$class, 'ftype'=>'duration','name'=>"Duration of visit(Hour)",'id'=>"duration", 'value' =>  1, 'required'=>true,],
           ['class'=>$class, 'ftype'=>'input','name'=>"Name",'id'=>"name",'placeholder'=>__('Name'),'required'=>true],
           ['class'=>$class, 'lableVsisibility'=>'invisible', 'ftype'=>'input','name'=>"Surname",'id'=>"sur_name",'placeholder'=>__('Surname')],
           ['class'=>$class.' col-6 pr-0', 'ftype'=>'input','name'=>"Email",'id'=>"email",'placeholder'=>__('Customer email'),'required'=>false],
           ['class'=>$class, 'ftype'=>'input','name'=>"Phone",'id'=>"phone_number",'placeholder'=>__('Customer phone'),'required'=>false],
           ['class'=>$class, 'ftype'=>'select','name'=>"Table",'id'=>"table_id",'placeholder'=>"Select table",'data'=>$tablesData,'required'=>true],
           ['class'=>$class, 'ftype'=>'input','name'=>"Note",'id'=>"note",'placeholder'=>__('Custom note'),'required'=>false],
           ['class'=>$class, 'type'=>'hidden','ftype'=>'input','name'=>"Restaurant",'id'=>"restaurant_id",'placeholder'=>__('Restaurant'),'required'=>true,'value'=>$restaurant->id],
           ['type'=>'hidden','ftype'=>'input','name'=>"customers.created_at",'id'=>"created_at",'placeholder'=>__('customer.created_at'),'required'=>true,'value' =>  Carbon::now()->toDayDateTimeString()],
       ];
   }
   private function getFieldsFront($class="col-md-6",$restaurant=null){
        if($restaurant==null){
            $restaurant=$this->getRestaurant();
        }

        $tables=Tables::where('restaurant_id',$restaurant->id)->get();
        $tablesData=[];
        foreach ($tables as $key => $table) {
            $tablesData[$table->id]=$table->restoarea?$table->restoarea->name." - ".$table->name:$table->name;
        }

        return [
             ['class'=>$class, 'ftype'=>'input','name'=>"Time of entry",'id'=>"",'placeholder'=>__('Time of entry'), 'required'=>true, 'value' =>  Carbon::now()->toDayDateTimeString(), 'disabled'=>true,],
             ['class'=>$class.' duration_cl', 'ftype'=>'duration','name'=>"Duration of visit(approximate)",'id'=>"duration", 'value' =>  1, 'required'=>true,],
            ['class'=>$class.'  col-12', 'ftype'=>'input','name'=>"Name",'id'=>"name",'placeholder'=>__('Name'),'required'=>true],
            ['class'=>$class.' col-12', 'lableVsisibility'=>'invisible-', 'ftype'=>'input','name'=>"Surname",'id'=>"sur_name",'placeholder'=>__('surname'),'required'=>true],
            ['class'=>$class.' col-12', 'ftype'=>'input','name'=>"Email",'id'=>"email",'placeholder'=>__('Customer email'),'required'=>false],
            ['class'=>$class.' col-12', 'ftype'=>'input','name'=>"Phone",'id'=>"phone_number",'placeholder'=>__('Customer phone'),'required'=>false],
            ['class'=>'col-md-12', 'ftype'=>'select','name'=>"Table",'id'=>"table_id",'placeholder'=>"Select table",'data'=>$tablesData,'required'=>true],
            ['class'=>'col-md-12', 'ftype'=>'input','name'=>"Note",'id'=>"note",'placeholder'=>__('Custom note'),'required'=>false],
            ['class'=>$class, 'type'=>'hidden','ftype'=>'input','name'=>"Restaurant",'id'=>"restaurant_id",'placeholder'=>__('Restaurant'),'required'=>true,'value'=>$restaurant->id],
            ['class'=>$class, 'type'=>'hidden','ftype'=>'input','name'=>"entry_time",'id'=>"entry_time",'placeholder'=>__('Time of entry'),'required'=>true,'value' =>  Carbon::now()->toDayDateTimeString()],
        ];
   }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $this->authChecker();

        $class="col-md-4";
        $fields=$this->getFields($class);
        $fields[1]['required']=false;
        $fields[9]['id']='';
        unset($fields[0]);unset($fields[3]);unset($fields[7]);unset($fields[8]);
        array_push($fields,['class'=>$class,'ftype'=>'select','name'=>"customers.created_by",'id'=>"by",'placeholder'=>"Select who created it",'data'=>["2"=>__('customers.him_self'),"1"=>__('customers.by_restaurant')],'required'=>false]);
        array_push($fields,['class'=>$class,'editclass'=>' daterange ','ftype'=>'input','name'=>"customers.visit_time",'id'=>"created_at",'placeholder'=>"customers.visit_time",'required'=>false]);
        array_push($fields,['class'=>$class,'ftype'=>'input','name'=>"customers.entry_time",'id'=>"entry_time",'placeholder'=>"Entry time",'required'=>false]);
        array_push($fields,['class'=>$class,'ftype'=>'input','name'=>"customers.out_time",'id'=>"out_time",'placeholder'=>"Out time",'required'=>false]);
        $items = $this->provider::where('restaurant_id',$this->getRestaurant()->id);
        //Filters
        if(\Request::exists('duration')&&\Request::input('duration').""!=""){
            $items = $items->where('duration',\Request::input('duration'));
        }
        if(\Request::exists('table_id')&&\Request::input('table_id').""!=""){
            $items = $items->where('table_id',\Request::input('table_id'));
        }
        if(\Request::exists('by')&&\Request::input('by').""!=""){
            $items = $items->where('by',\Request::input('by'));
        }
        if(\Request::exists('name')&&\Request::input('name').""!=""){
            $items = $items->where('name','like','%'.\Request::input('name').'%');
        }
        if(\Request::exists('email')&&\Request::input('email').""!=""){
            $items = $items->where('email','like','%'.\Request::input('email').'%');
        }
        if(\Request::exists('phone_number')&&\Request::input('phone_number').""!=""){
            $items = $items->where('phone_number','like','%'.\Request::input('phone_number').'%');
        }
        if(\Request::exists('note')&&\Request::input('note').""!=""){
            $items = $items->where('note','like','%'.\Request::input('note').'%');
        }
        if(\Request::exists('created_at')&&\Request::input('created_at').""!=""){
            $dates=explode(" - ",\Request::input('created_at'));
            $from = (Carbon::createFromFormat('d/m/Y',$dates[0]))->toDateString();
            $to = (Carbon::createFromFormat('d/m/Y',$dates[1]))->toDateString();
            //Apply dated
            $items->whereDate('entry_time', '>=',$from)->whereDate('out_time', '<=',$to);

        }

        //Sorting
        $items = $items->orderBy('id','desc');

        //With downloaod
        if(isset($_GET['report'])){
            $itemsForExport=array();
            foreach ($items->get() as $key => $item) {
                $item=array(
                    "visit_id"=>$item->id,
                    "table"=>isset($item->table->name) ? $item->table->name : 'Pickup',
                    "area"=>isset($item->table->restoarea) ? $item->table->restoarea ?$item->table->restoarea->name:"" : '',
                    "customer_name"=>isset($item->surname) ? $item->name.' '.$item->surname : $item->name,
                    "customer_email"=>$item->email,
                    "customer_phone_number"=>$item->phone_number,
                    "note"=>$item->note,
                    "by"=>$item->by.""=="1"?__('customers.by_restaurant'):__('customers.him_self'),
                    'duration_of_visit' => $item->duration.' Hour',
                    'visit_time' => $item->out_time ? Carbon::parse($item->entry_time)->toDayDateTimeString().' To '.Carbon::parse($item->out_time)->toDayDateTimeString() : Carbon::parse($item->entry_time)->toDayDateTimeString().' Out is remaining!',
                    "created"=> Carbon::parse($item->created_at)->toDayDateTimeString()
                );
                array_push($itemsForExport,$item);
            }

            return Excel::download(new VisitsExport($itemsForExport), 'visits_'.time().'.xlsx');
        }

        //Pagiinate
        $items = $items->paginate(env('PAGINATE',10));
        return view($this->view_path.'index', ['setup' => [
            'usefilter'=>true,
            'title'=>__('crud.item_managment',['item'=>__($this->titlePlural)]),
            'action_link'=>route($this->webroute_path.'create'),
            'action_name'=>__('crud.add_new_item',['item'=>__($this->title)]),
            'items'=>$items,
            'item_names'=>$this->titlePlural,
            'webroute_path'=>$this->webroute_path,
            'fields'=>$fields,
            'parameter_name'=>$this->parameter_name,
            'parameters'=>count($_GET)!=0
        ]]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fields = $this->getFieldsFront();
        $fields[3]['required'] = false;
        $fields[3]['lableVsisibility'] = '';
        unset($fields[8]);unset($fields[9]);
        /*dd($fields);*/
        $this->authChecker();
        return view('general.form', ['setup' => [
            'inrow'=>true,
            'title'=>__('crud.new_item',['item'=>__($this->title)]),
            'action_link'=>route($this->webroute_path.'index'),
            'action_name'=>__("crud.back"),
            'iscontent'=>true,
            'action'=>route($this->webroute_path.'store'),
        ],
        'fields'=>$fields]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authChecker();
        $item = $this->provider::create([
            'name'=>$request->name,
            'restaurant_id'=>$this->getRestaurant()->id,
            'surname' => $request->sur_name,
            /*'table_id'=>$request->table_id,*/
            'phone_number'=>$request->phone_number,
            'email'=>$request->email,
            'note'=>$request->note,
            'duration'=>$request->duration,
            'entry_time'=>Carbon::parse($request->entry_time)->toDateTimeString()
        ]);
        $item->save();
        return redirect()->route($this->webroute_path.'index')->withStatus(__('crud.item_has_been_added',['item'=>__($this->title)]));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\RestoArea  $restoArea
     * @return \Illuminate\Http\Response
     */
    public function show(RestoArea $restoArea)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  integer $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    { 
        $this->authChecker();
        $item=$this->provider::findOrFail($id);
        $class="col-md-4";
        $fields=$this->getFields();
         array_push($fields,['ftype'=>'input','name'=>"customers.out_time",'id'=>"out_time",'placeholder'=>"Out time",'required'=>false, 'class'=>'col-md-6']);
        $fields[0]['value']=$item->entry_time ? $item->entry_time : Carbon::createFromFormat('Y-m-d H:i:s', Carbon::today())->toDateTimeString();
        $fields[1]['value']=$item->duration;
        $fields[2]['value']=$item->name;
        $fields[3]['value']=$item->surname;
        $fields[4]['value']=$item->email;
        $fields[5]['value']=$item->phone_number;
        $fields[6]['value']=$item->table_id;
        $fields[7]['value']=$item->note;
        $fields[10]['value']=$item->out_time ? $item->out_time : Carbon::createFromFormat('Y-m-d H:i:s', Carbon::today())->toDateTimeString();
        unset($fields[8]);unset($fields[9]);
        $fields[3]['lableVsisibility'] = '';
        $parameter=[];
        $parameter[$this->parameter_name]=$id;
        return view('general.form', ['setup' => [
            'inrow'=>true,
            'title'=>__('crud.edit_item_name',['item'=>__($this->title),'name'=>$item->name]),
            'action_link'=>route($this->webroute_path.'index'),
            'action_name'=>__("crud.back"),
            'iscontent'=>true,
            'isupdate'=>true,
            'action'=>route($this->webroute_path.'update',$parameter),
        ],
        'fields'=>$fields]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  integer  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //dd($request->all());
        $this->authChecker();
        $item=$this->provider::findOrFail($id);
        $item->name=$request->name;
        $item->surname=$request->sur_name;
        $item->table_id=$request->table_id;
        $item->email=$request->email;
        $item->phone_number=$request->phone_number;
        $item->note=$request->note;
        $item->duration=$request->duration;
        $item->entry_time=Carbon::parse($request->entry_time)->toDateTimeString();
        $item->out_time=Carbon::parse($request->out_time)->toDateTimeString();
        $item->update();
        return redirect()->route($this->webroute_path.'index')->withStatus(__('crud.item_has_been_updated',['item'=>__($this->title)]));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  integer  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authChecker();
        $item=$this->provider::findOrFail($id);
        if($item->tables->count()>0){
            return redirect()->route($this->webroute_path.'index')->withStatus(__('crud.item_has_items_associated',['item'=>__($this->title)]));
        }else{
            $item->delete();
            return redirect()->route($this->webroute_path.'index')->withStatus(__('crud.item_has_been_removed',['item'=>__($this->title)]));
        }

    }


    public function register($restaurant_id){
        $restaurant=Restorant::findOrFail($restaurant_id);
        $fields = $this->getFields('col-md-6',$restaurant);
        $fields[0]['disabled'] = true;
        if(\Request::has('table')){
            $fields[6]['value'] = \Request::input('table');
        }
        return view('general.form_front', ['setup' => [
            'inrow'=>true,
            'action_link'=>route('vendor',['alias'=>$restaurant->subdomain]),
            'action_name'=>__("crud.back"),
            'title'=>__('crud.new_item',['item'=>__($this->title)]),
            'iscontent'=>true,
            'action'=>route('register.visit.store'),
        ],
        'fields'=>$fields]);
    }

    public function registerstore(Request $request)
    {
        $restaurant=Restorant::findOrFail($request->restaurant_id);
        $item = $this->provider::create([
            'name'=>$request->name,
            'restaurant_id'=>$request->restaurant_id,
            'table_id'=>$request->table_id,
            'phone_number'=>$request->phone_number,
            'email'=>$request->email,
            'note'=>$request->note,
            'by'=>2,
            'surname'=>$request->sur_name,
            'entry_time'=>Carbon::parse($request->entry_time)->toDateTimeString(),
            'duration'=>$request->duration,

        ]);
        $item->save();
        return redirect()->route('vendor',['alias'=>$restaurant->subdomain])->withStatus(__('crud.item_has_been_added',['item'=>__($this->title)]));
    }
    public function registerstoreAjax(Request $request)
    {
        $item = $this->provider::create([
            'name'=>$request->name,
            'restaurant_id'=>$request->restaurant_id,
            'table_id'=>$request->table_id,
            'phone_number'=>$request->phone_number,
            'email'=>$request->email,
            'note'=>$request->note,
            'by'=>2,
            'surname'=>$request->sur_name,
            'entry_time'=>$request->entry_time,
            'duration'=>$request->duration,
        ]);
        if($item->save()){
          return response()->json(['status' => 'ok','msg'=>'visited successfully!','data' => $item]);
      }
  }
  public function updateOutTime(Request $request)
    {
        $this->authChecker();
        $item=$this->provider::findOrFail($request->id);
        $item->out_time=Carbon::parse($request->date)->toDateTimeString();
        if($item->update()){ 
        return response()->json(['status'=>'success', 'message'=>'Out time updated!']);
        }else{
            return response()->json(['status'=>'failed', 'message'=>'Network error!']);
        }
  }
}

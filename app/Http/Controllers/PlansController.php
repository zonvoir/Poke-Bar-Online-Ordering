<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Plans;
use App\User;

class PlansController extends Controller
{
    private function adminOnly(){
        if(!auth()->user()->hasRole('admin')){
            abort(403, 'Unauthorized action.');
        }
    }

    public function current(){
        //The curent plan -- access for owner only
        if(!auth()->user()->hasRole('owner')){
            abort(403, 'Unauthorized action.');
        }
        $plans=Plans::get()->toArray();
        $colCounter=[4,12,6,4,3,4,4,4,4,4,4,4,4,4,4,4,4];

        $currentUserPlan=Plans::withTrashed()->find(auth()->user()->mplanid());
        

        $data=[
            'col'=>$colCounter[count($plans)],
            'plans'=>$plans,
            'currentPlan'=>$currentUserPlan
        ];
        if(env('SUBSCRIPTION_PROCESSOR','Stripe')=='Stripe'){
            $data['intent'] = auth()->user()->createSetupIntent();

            if (auth()->user()->subscribed('main')) {
                //Subscribed
                //Switch the user to the free plan
                //auth()->user()->plan_id=env('FREE_PRICING_ID',1);
                //auth()->user()->update();
                //$currentUserPlan=Plans::findOrFail(auth()->user()->mplanid());
                //$data['currentPlan']=$currentUserPlan;
            }else{
                //not subscribed
               
            }

            
        }

        return view('plans.current',$data);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Plans $plans)
    {   
        $this->adminOnly();
        return view('plans.index', ['plans' => $plans->paginate(10)]);
    }

    public function paddle(Request $request){
        //Email - find the user
        $email=$request->email;
        $user=User::where('email',$email)->firstOrFail();

        //subscription_id -- Find the plan
        $subscription_plan_id=$request->subscription_plan_id;
        $plan=Plans::where('paddle_id',$subscription_plan_id)->firstOrFail();

        //Status is to decide what to do
        $status=$request->status;

        if($status=="active"||$status=="trialing"){
            //Assign the user this plan
            $user->plan_id=$plan->id;
            $user->plan_status=$status;
            $user->cancel_url=$request->cancel_url;
            $user->update_url=$request->update_url;
            $user->subscription_plan_id=$request->subscription_plan_id;
            $user->update();

        }

        if($status=="deleted"){
            //Remove assigned plan to user
            $user->plan_id=null;
            $user->plan_status="";
            $user->cancel_url="";
            $user->update_url="";
            $user->subscription_plan_id=null;
            $user->update();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->adminOnly();
        return view('plans.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->adminOnly();
        $plan = new Plans;
        $plan->name = strip_tags($request->name);
        $plan->price = strip_tags($request->price);
        $plan->limit_items = strip_tags($request->limit_items);
        $plan->limit_orders = 0;
        $plan->paddle_id = strip_tags($request->paddle_id);
        $plan->stripe_id = strip_tags($request->stripe_id);
        $plan->period = $request->period == "monthly" ? 1 : 2;
        $plan->enable_ordering = $request->ordering == "enabled" ? 1 : 2;

        $plan->save();

        return redirect()->route('plans.index')->withStatus(__('Plan successfully created!'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Plans $plan)
    {
        $this->adminOnly();
        return view('plans.edit',['plan' => $plan]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Plans $plan)
    {
        $this->adminOnly();
        $plan->name = strip_tags($request->name);
        $plan->price = strip_tags($request->price);
        $plan->limit_items = strip_tags($request->limit_items);
        $plan->limit_orders = 0;
        $plan->paddle_id = strip_tags($request->paddle_id);
        $plan->stripe_id = strip_tags($request->stripe_id);
        $plan->period = $request->period == "monthly" ? 1 : 2;
        $plan->enable_ordering = $request->ordering == "enabled" ? 1 : 2;
        $plan->description=$request->description;
        $plan->features=$request->features;

        $plan->update();

        return redirect()->route('plans.index')->withStatus(__('Plan successfully updated!'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Plans $plan)
    {
        $this->adminOnly();
        $plan->delete();

        return redirect()->route('plans.index')->withStatus(__('Plan successfully deleted!'));
    }

    public function subscribe(Request $request){
        $plan=Plans::findOrFail($request->plan_id);
        $plan_stripe_id= $plan->stripe_id;

        //Shold we do a swap
        if (auth()->user()->subscribed('main')) {
            //SWAP
            $user->subscription('main')->swap($plan_stripe_id);
        }else{
            //NEW
            $payment_stripe=auth()->user()->newSubscription('main', $plan_stripe_id)->create($request->stripePaymentId);
        }

        //Assign user to plan
        auth()->user()->plan_id= $plan->id;
        auth()->user()->update();

        return redirect()->route('plans.current')->withStatus(__('Plan update!'));

    }

    public function adminupdate(Request $request){
        $this->adminOnly();
        $user=User::findOrFail($request->user_id);
        $user->plan_id=$request->plan_id;
        $user->update();
        return redirect()->route('admin.restaurants.edit',['id' => $request->restaurant_id])->withStatus(__('Plan successfully updated.'));
       
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = ['fee','fee_value','static_fee','vatvalue'];

    public function restorant()
    {
        return $this->belongsTo('App\Restorant');
    }

    public function driver()
    {
        return $this->hasOne('App\User','id','driver_id');
    }

    public function table()
    {
        return $this->hasOne('App\Tables','id','table_id');
    }

    public function address()
    {
        return $this->hasOne('App\Address','id','address_id');
    }

    public function client()
    {
        return $this->hasOne('App\User','id','client_id');
    }

    public function status()
    {
        return $this->belongsToMany('App\Status','order_has_status','order_id','status_id')->withPivot('user_id','created_at','comment')->orderBy('order_has_status.id','ASC');;
    }

    public function laststatus()
    {
        return $this->belongsToMany('App\Status','order_has_status','order_id','status_id')->withPivot('user_id','created_at','comment')->orderBy('order_has_status.id','DESC')->limit(1);
    }

    public function stakeholders()
    {
        return $this->belongsToMany('App\User','order_has_status','order_id','user_id')->withPivot('status_id','created_at','comment')->orderBy('order_has_status.id','ASC');;
    }

    public function items()
    {
        return $this->belongsToMany('App\Items','order_has_items','order_id','item_id')->withPivot(['qty','extras','vat','vatvalue','variant_price','variant_name']);
    }


    public function getTimeFormatedAttribute()
    {
        $parts=explode('_',$this->delivery_pickup_interval);
        if(count($parts)<2){
            return "";
        }
        
        $hoursFrom=(int)(($parts[0]/60)."");
        $minutesFrom=$parts[0]-($hoursFrom*60);
        
        
        $hoursTo=(int)(($parts[1]/60)."");
        $minutesTo=$parts[1]-($hoursTo*60);
        

        $format="G:i";
        if(env('TIME_FORMAT',"24hours")=="AM/PM"){
            $format="g:i A";
        }
        $from=date($format, strtotime($hoursFrom.":".$minutesFrom));
        $to=date($format, strtotime($hoursTo.":".$minutesTo));

        


        return $from." - ".$to;
    }

    public static function boot() 
    {
        parent::boot();
        self::deleting(function(Order $order) {
            //Delete Order items
            $order->items()->detach();
            //Delete Oders statuses
            $order->status()->detach();
            
            return true;
        });
    }
    /*sushant 20-11-2020*/
    public function ratings()
    {
        return $this->hasOne('App\Ratings','id','order_id');
    }
    /*sushant 20-11-2020*/

}

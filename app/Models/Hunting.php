<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use App\Models\ProductOffer;
use Carbon\Carbon;

class Hunting extends Model
{
    protected $table = 'huntings';

    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'name',
        'slug',
        'description',
        'price',
        'country_id',
        'view',
        'image_path'
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function user(){
        return $this->hasOne('App\Models\User', 'user_id', 'id');
    }

    public function country(){
        return $this->hasOne('App\Models\Country', 'country_id', 'id');
    }

    /**
     * Show sent offers
     *
     * @return int
     */
    public function sentOffers(){
        $offers = ProductOffer::where('hunting_id', $this->id)->get();
        return count($offers);
    }

    /**
     * Show avg price
     *
     * @return int
     */
    public function avgPrice(){
        $offers = ProductOffer::where('status', 'active')->get();
        $count = 0;
        $tempt = 0;
        foreach ($offers as $value) {
            $tempt += $value->offer_price;
            $count++;
        }
        if($count != 0) {
            return $tempt/$count;
        }
        return 0;
    }

    /**
     * Show product view
     *
     * @return int
     */
    public function view(){
        return $this->view;
    }

    public function isOwnTopic($id) {
        if($id == $this->user_id) {
            return true;
        }
        return false;
    }

    public function Offered($userId) {
        $offer = ProductOffer::where('status','active')->where('hunting_id', $this->id)->where('user_id', $userId)->first();
        if( $offer == null ) {
            return true;
        }
        return false;
    }

    public function isActive() {
        if( $this->status == 'active' ) {
            return true;
        }
        return false;
    }

    public function getLabelNewProduct($created_at) {
        if( Carbon::now()->subDays(7) <= $created_at ) {
            return true;
        }
        return false;
    }
}

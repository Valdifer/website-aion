<?php

namespace App\Models\Gameserver;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Lang;

class Player extends Model {

    protected $table        = 'players';
    protected $connection   = 'gameserver';
    protected $fillable     = ['account_name'];
    public $timestamps      = false;

    /**
     * Add in Scope function for select player online
     */
    public function scopeOnline($query)
    {
        return $query->where('online', 1);
    }

    /**
     * Return legion
     * @param  [type] $query [description]
     * @return [type]        [description]
     */
    public function scopeLegion($query)
    {
        return $query->with(['memberOfALegion' => function($query2){
            return $query2->with(['legion']);
        }]);
    }

    /**
     * Return player level base on the exp
     *
     * @param integer $value 2314763
     *
     * @return integer 19
     */
    public function getExpAttribute($value)
    {
        $expMapper = Lang::get('aion.exp');

        foreach($expMapper as $xp => $level) {
            if($value <= $xp){
                return $level;
                break;
            }
        }
    }

    /**
     * Return name of the map
     *
     * @param  integer $value 110010000
     *
     * @return string Sanctum
     */
    public function getWorldIdAttribute($value)
    {
        $mapMapper = Lang::get('aion.map');

        foreach ($mapMapper as $id => $name) {
            if($value == $id){
                return $name;
                break;
            }
        }
    }

    /**
     * Return Legion Members
     */
    public function memberOfALegion()
    {
        return $this->belongsTo('App\Models\Gameserver\LegionMember', 'id', 'player_id');
    }
}

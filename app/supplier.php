<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
class supplier extends Model
{
    use LogsActivity;

        protected static $logAttributes = ['name','alamat','telp'];
        protected static $recordEvents = ['Created','Updated','Deleted'];
        public function getDescriptionForEvent(string $eventName): string
        {
            return "{$eventName} supplier";
        }
        protected static $logName = "Supplier";

    protected $table='suppliers';
    protected $fillable=['name','alamat','telp'];

public function product(){
   return $this-> belongsTo(product::class);
}
}
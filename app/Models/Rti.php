<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Rti extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'dispatch_no', 
        'unique_applicant_no',
        'applicant_name',
        'received_date',
        'mobile_no',
        'date',
        'subject',
        'concerned_department',
        'name_of_concerned_officer'
    ];


    public static function booted()
    {
        static::created(function (self $user)
        {
            if(Auth::check())
            {
                self::where('id', $user->id)->update([
                    'created_by'=> Auth::user()->id,
                ]);
            }
        });
        static::updated(function (self $user)
        {
            if(Auth::check())
            {
                self::where('id', $user->id)->update([
                    'updated_by'=> Auth::user()->id,
                ]);
            }
        });
        static::deleting(function (self $user)
        {
            if(Auth::check())
            {
                self::where('id', $user->id)->update([
                    'deleted_by'=> Auth::user()->id,
                ]);
            }
        });
    }
}

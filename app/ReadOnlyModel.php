<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ReadOnlyModel extends Model
{
    public static function get_tax_type(){
        return $tax_type = ["","",""];
        return DB::table('activity_member')
            ->join('activity', 'activity_member.activity_id', '=', 'activity.activity_id')
            ->join('student', 'activity_member.serial', '=', 'student.serial')
            ->where('activity_member.activity_id', $activity_id)
            ->get();
	}
}

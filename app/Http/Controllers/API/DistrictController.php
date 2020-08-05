<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\District;

class DistrictController extends Controller
{
  public function provinces()
  {
    $provinces = District::groupBy('province_code')
      ->get();
    return response()->json($provinces);
  }
  public function amphoes($province_code)
  {
    $amphoes = District::where('province',$province_code)
      ->groupBy('amphoe_code')
      ->get();
    return response()->json($amphoes);
  }
  public function districts($province_code,$amphoe_code)
  {
    $districts = District::where('province',$province_code)
      ->where('amphoe',$amphoe_code)
      ->groupBy('district_code')
      ->get();
    return response()->json($districts);
  }
  public function detail($province_code,$amphoe_code,$district_code)
  {
    $districts = District::where('province',$province_code)
      ->where('amphoe',$amphoe_code)
      ->where('district',$district_code)
      ->get();
    return response()->json($districts);
  }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Models\Region;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class RegionController extends Controller
{


    /**
     *
     */

    public  function show(Request $request)
    {
        $id =  $request->input('id');

        $data = Region::where('parent_id',$id)->get()->toArray();

        return json_encode($data);
    }

}

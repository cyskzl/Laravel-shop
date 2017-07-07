<?php

namespace App\Http\Controllers\Admin;

use App\Models\DelveryMethod;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class DeliverMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $delvery = DelveryMethod::orderBy('id', 'desc')->where(function ($query) use ($request){

            if (!empty($request->input('keyword'))){
                $query->where('name','like','%'.$request->input('keyword').'%');
            }

        })->paginate(10);

        $sum = count($delvery);

        return view('admin.main.settings/deliverymethod.index',compact('delvery','request','sum'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.main.settings/deliverymethod.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data = json_decode($request->input('json'),true);

        $per = '/^\d{1,}$/';

        if (!preg_match($per,$data['price'])){
            $data = [
                'status' => 1,
                'msg'    => '邮费只可以填数值'
            ];
            return $data;
        }

        if (empty($data['name'])){
            $data = [
                'status' => 2,
                'msg'    => '快递名称不可为空'
            ];
            return $data;
        }

        $deliverModel = new DelveryMethod();

        $deliverModel->name = $data['name'];

        $deliverModel->price = $data['price'];

        $deliverModel->desc = $data['desc'];

        if ($deliverModel->save()){
            $data = [
                'status' => 0,
                'msg'    => '添加成功'
            ];
            return $data;
        }else{
            $data = [
                'status' => 3,
                'msg'    => '添加失败'
            ];
            return $data;
        }
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
    public function edit(Request $request,$id)
    {
        //
        $model = $request->input('model');

        if ($model){

            $data = DelveryMethod::findOrfail($id);

            $show = $data->enabled;

            switch ($show){
                case 0:
                    $show = 1;
                    break;
                case 1:
                    $show = 0;
                    break;
                default:
                    return '{"error":"1"}';
                    break;
            }

            $result = DelveryMethod::where('id','=',$id)->update(['enabled'=>$show]);

            if($result == 0){
                return '{"error":"2"}';
            }

            return '{"error":"0"}';
        }
        $delver = DelveryMethod::find($id)->get();

        $delvery = $delver[0];

        return view('admin.main.settings/deliverymethod.edit',compact('delvery'));


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //


        $data = json_decode($request->input('json'),true);

        if ($id != $data['id']){
            $data = [
                'status' => 1,
                'msg'    => '删除失败,请刷新'
            ];
            return $data;
        }

        $delvery = DelveryMethod::find($id);

        $delvery->name = $data['name'];

        $delvery->price = $data['price'];

        $delvery->desc = $data['desc'];

        if ($delvery->save()){
            $data = [
                'status' => 0,
                'msg'    => '删除成功'
            ];
            return $data;

        }else{

            $data = [
                'status' => 2,
                'msg'    => '删除失败'
            ];
            return $data;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return int   0  删除成功    1 删除失败
     */
    public function destroy($id)
    {
        //
        $del = DelveryMethod::where('id',$id)->delete();

        if ($del){
            //删除成功返回
            return 0;
        }else{
            //删除失败返回
           return 1;
        }

    }
}

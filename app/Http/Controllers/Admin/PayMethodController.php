<?php

namespace App\Http\Controllers\Admin;

use App\Models\PayMethod;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PayMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $paydata = PayMethod::orderBy('id', 'desc')->where(function ($query) use ($request){

            if (!empty($request->input('keyword'))){
                $query->where('name','like','%'.$request->input('keyword').'%');
            }

        })->paginate(10);

        $sum = count($paydata);

        return view('admin.main.settings/paymethod.index',compact('paydata','request','sum'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.main.settings/paymethod.create');
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

        if (empty($data['name'])){
            $data = [
                'status' => 2,
                'msg'    => '快递名称不可为空'
            ];
            return $data;
        }

        if ($data['enabled'] === '0'){

            $enabled = $data['enabled'];

        }else{

            $enabled = 1;
        }

        $payModel = new PayMethod();

        $payModel->pay_name = $data['name'];

        $payModel->pay_desc = $data['desc'];

        $payModel->enabled = $enabled;

        if ($payModel->save()){
            $data = [
                'status' => 0,
                'msg'    => '添加成功'
            ];
            return $data;
        }else{
            $data = [
                'status' => 1,
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

            $data = PayMethod::findOrfail($id);

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

            $result = PayMethod::where('id','=',$id)->update(['enabled'=>$show]);

            if($result == 0){
                return '{"error":"2"}';
            }

            return '{"error":"0"}';
        }

        $payMethod = PayMethod::where('id',$id)->get();

        $payMethod = $payMethod[0];

        return view('admin.main.settings/paymethod.edit',compact('payMethod'));
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
                'msg'    => '修改失败,请刷新'
            ];
            return $data;
        }

        $paymethod = PayMethod::find($id);

        $paymethod->pay_name = $data['name'];

        $paymethod->enabled = $data['enabled'];

        $paymethod->pay_desc = $data['desc'];

        if ($paymethod->save()){
            $data = [
                'status' => 0,
                'msg'    => '修改成功'
            ];
            return $data;

        }else{

            $data = [
                'status' => 2,
                'msg'    => '修改失败'
            ];
            return $data;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $del = PayMethod::where('id',$id)->delete();

        if ($del){
            //删除成功返回
            return 0;
        }else{
            //删除失败返回
            return 1;
        }
    }
}

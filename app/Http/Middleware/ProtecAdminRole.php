<?php

namespace App\Http\Middleware;

use Closure;


class ProtecAdminRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $id   = $request->route('adminrole');
        $role = \DB::table('roles')->where('id',$id)->first($id);
        // dd($role);
        if ($role->name !== 'admin') {
            return $next($request);
        }
        $error['success'] = 0;
        $error['info']    = '非法操作，默认角色不能删除';
        return json_encode($error);
    }
}

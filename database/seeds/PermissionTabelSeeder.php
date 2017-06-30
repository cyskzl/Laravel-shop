<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\Permission;
use App\Models\AdminUser;


class PermissionTabelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //清空权限相关的数据表
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Permission::truncate();
        Role::truncate();
        AdminUser::truncate();
        DB::table('role_user')->delete();
        DB::table('permission_role')->delete();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
        //创建初始管理员用户
        $admin_user = AdminUser::create([
            'nickname'=>'admin',
            'email'=>'admin@qq.com',
            'password'=>bcrypt('admin'),
            'status'=>'1'
        ]);

        //创建初始角色
        $role = Role::create([
            'name'=>'admin',
            'display_name'=>'管理员',
            'description'=>'管理员'
        ]);

        //创建相应的权限
        $permission = [
            [
                'name'=>'admin_list',
                'display_name'=>'管理员列表',
                'description'=>'管理员列表'
            ],

            [
                'name'=>'create_admin',
                'display_name'=>'创建管理员',
                'description'=>'创建管理员'
            ],

            [
                'name'=>'edit_admin',
                'display_name'=>'修改管理员',
                'description'=>'修改管理员'
            ],

            [
                'name'=>'delete_admin',
                'display_name'=>'删除管理员',
                'description'=>'删除管理员'
            ],
        ];

        foreach ($permission as $value){
            $manage_user = Permission::create($value);
            //给角色赋予相应的权限
            $role->attachPermission($manage_user);
        }

        //给用户赋予相应的角色
        $admin_user->attachRole($role);


    }
}

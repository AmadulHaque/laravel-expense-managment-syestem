<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth,Image,File,DB;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Type\Integer;

class UserController extends Controller
{
    //
    public function userAll(Request $request)
    {
      if ($request->ajax()) {
          $search = @$request->search;
          $perPage = @$request->perPage ? $request->perPage : 10;
          $data=User::orderBy('id', 'desc');
          if($request->search){
              $data->where('name', 'like', '%'.$request->search.'%')
              ->orWhere('phone', 'like', '%'.$request->search.'%');
          }
          $datas = $data->paginate($perPage);

          return view('backend.components.user.table',compact('datas'));
      }
      $roles = Role::all();
      return view('backend.pages.user.index',compact('roles'));
    }


    public function userStore(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:11','unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'roles' => ['required'],
            'address' => ['required'],
        ]);

        if ($validator->passes()) {
            if ($request->file('photo')) {
                $image = $request->file('photo');
                $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension(); // 343434.png
                Image::make($image)->resize(200,200)->save('images/profile/'.$name_gen);
                $save_url = 'images/profile/'.$name_gen;
            }else{
                $save_url =null;
            }

            $user = new User();
            $user->name = $request->name;
            $user->username = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->address = $request->address;
            $user->photo = $save_url;
            $user->password = Hash::make($request->password);
            $user->save();
            $role = intval($request->roles);
            if ($request->roles) {
                $user->assignRole($role);
            }

           return response()->json(['success'=>1]);
        }else{
             return response()->json([$validator->errors()]);
        }
    }


    function userEdit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('backend.components.user.edit',compact('user','roles'));
    }


    public function userUpdate(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:11'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'roles' => ['required'],
            'address' => ['required'],
        ]);

      if ($validator->passes()) {
            $user = User::findOrFail($request->id);
            if ($request->file('photo')) {
                $image = $request->file('photo');
                $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension(); // 343434.png
                Image::make($image)->resize(200,200)->save('images/profile/'.$name_gen);
                $save_url = 'images/profile/'.$name_gen;
                //
                if ($user->photo) {
                    unlink($user->photo);
                }
            }else{
                $save_url = $user->photo;
            }

            $user->name = $request->name;
            $user->username = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->address = $request->address;
            $user->photo = $save_url;
            if($request->password){
                $user->password = Hash::make($request->password);
            }
            $user->save();
            $role = intval($request->roles);
            if ($request->roles){
                foreach($user->roles as $item){
                    $user->removeRole($item->id);
                }
                $user->assignRole($role);
            }
           return response()->json(['success'=>1]);
        }else{
             return response()->json([$validator->errors()]);
         }
    }

    public function userRemove($id) {  }


    public function roleMnage()
    {
        $roles = Role::all();
        return view('backend.pages.user.role',compact('roles'));
    }


    public function AddRolePermission()
    {
        $roles = Role::all();
        $permission = Permission::all();
        $permission_groups = User::getpermissionGroups();
        return view('backend.pages.user.add_role',compact('roles','permission','permission_groups'));
    }

    public function roleStore(Request $request)
    {
        $data = array();
        $permissions = $request->permission;

        if ($permissions == null) {
            return redirect()->back()->with('info','Data Not Found!');
        }
        foreach($permissions as $key => $item){
            $check =  DB::table('role_has_permissions')->where('role_id',$request->role_id )->where('permission_id',$item)->count();
            if ($check > 0) {
                return redirect()->back()->with('info','Data Already Used!');
            }else{
                $data['role_id'] = $request->role_id;
                $data['permission_id'] = $item;
                DB::table('role_has_permissions')->insert($data);
            }
        }
        return redirect()->back()->with('success','Add Success!');

    }

    public function EditRolePermission($id)
    {
        $roles = Role::all();
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        $permission_groups = User::getpermissionGroups();
        return view('backend.pages.user.edit_role',compact('roles','role','permissions','permission_groups'));
    }

    public function UpdateRolePermission(Request $request,$id)
    {
        $role = Role::findOrFail($id);
        $permissions = $request->permission;

        if (!empty($permissions)) {
           $role->syncPermissions($permissions);
        }
        return redirect()->back()->with('success','Role Permission Updated Successfully!');
    }

    // public function RemoveRolePermission($id)
    // {
    //     $role = Role::findOrFail($id);
    //     if (!is_null($role)) {
    //         $role->delete();
    //     }
    //     return redirect()->back()->with('success','Role Permission Delete Successfully!');

    // }

}

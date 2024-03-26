<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Category;
use Auth,Validator,Image,File,DB;

class CategoryController extends Controller
{

    public function CategoryAll(Request $request)
    {
      if ($request->ajax()) {
          $search = @$request->search;
          $perPage = @$request->perPage ? $request->perPage : 10;
          $data=Category::orderBy('id', 'desc');
          if($request->search){
              $data->where('name', 'like', '%'.$request->search.'%');
          }
          $datas = $data->paginate($perPage);
          return view('backend.components.category.table',compact('datas'));
      }
      return view('backend.pages.category.index');
    }

    public function CategoryStore(Request $request)
    {
      $validator =  Validator::make($request->all(), [
          'name' => 'required|unique:categories',
          'type' => 'required',
      ]);
      if ($validator->passes()) {
           Category::insert([
              'name' => $request->name,
              'type' => $request->type,
              'status' =>'1',
              'created_by' => Auth::user()->id,
              'created_at' => Carbon::now(),
           ]);
           return response()->json(['success'=>1]);
        }else{
             return response()->json([$validator->errors()]);
         }
    }

    public  function CategoryEdit($id)
    {
      $data = Category::findOrFail($id);
       return view('backend.components.category.edit',compact('data'));
    }

    public function CategoryUpdate(Request $request){
      $validator =  Validator::make($request->all(), [
          'name' => 'required',
          'type' => 'required',

      ]);
      if ($validator->passes()) {
          Category::findOrFail($request->id)->update([
              'name' => $request->name,
              'type' => $request->type,
              'status' => '1',
              'created_by' => Auth::user()->id,
              'created_at' => Carbon::now(),
           ]);
           return response()->json(['success'=>1]);
        }else{
             return response()->json([$validator->errors()]);
         }
    }

    public function CategoryRemove($id)
    {
      $check = DB::table('transactions')->where('category_id',$id)->count();
      if ($check > 0) {
          return response()->json([
            "status"=>305,
            "message"=>"Category Associate  With Transaction!"
          ]);
      }else{
        Category::findOrFail($id)->delete();
      }
    }





}

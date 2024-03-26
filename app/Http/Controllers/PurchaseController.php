<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth,Image,File,DB;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class PurchaseController extends Controller
{

    public function purchasesAll(Request $request)
    {
        $searchVal = $request->search;
      if ($request->ajax()) {
          $search = @$request->search;
          $perPage = @$request->perPage ? $request->perPage : 10;
          $data=Purchase::orderBy('id', 'desc');
          if($request->search){
              $data->where('name', 'like', '%'.$request->search.'%');
          }
          if($request->date){
              $data->whereDate('date', $request->date);
          }
          $amount = $data->sum('amount');
          $datas = $data->paginate($perPage);
          return view('backend.components.purchase.table',compact('datas','amount'));
      }
      $users = User::all();
      return view('backend.pages.purchase.index',compact('users'));
    }

    public function purchasestore(Request $request){
        $validator =  Validator::make($request->all(), [
            'name' => 'required',
            'amount' => 'required',
            'quantity' => 'required',
            'user_id' => 'required',
            'note' => 'required',
            'date' => 'required',
        ]);

        if ($validator->passes()) {
            if ($request->file('image')) {
                $image = $request->file('image');
                $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension(); // 343434.png
                Image::make($image)->resize(400,400)->save('images/purchase/'.$name_gen);
                $save_url = 'images/purchase/'.$name_gen;
            }else{
              $save_url =null;
            }
            Purchase::insert([
                'name' => $request->name,
                'image' => $save_url,
                'quantity' => $request->quantity,
                'amount' => $request->amount,
                'note' => $request->note,
                'created_by' =>  $request->user_id,
                'date' => $request->date,
                'created_at' =>Carbon::now(),
            ]);
            return response()->json(['success'=>1]);
        }else{
            return response()->json([$validator->errors()]);
        }
    }


    function purchasesEdit($id)
    {
        $users = User::all();
        $purchase = Purchase::findOrFail($id);
        return view('backend.components.purchase.edit',compact('purchase','users'));
    }


    public function purchasesUpdate(Request $request){
        $validator =  Validator::make($request->all(), [
            'name' => 'required',
            'amount' => 'required',
            'quantity' => 'required',
            'user_id' => 'required',
            'note' => 'required',
            'date' => 'required',
        ]);

        $img=DB::table('purchases')->where('id',$request->id)->first();  //product data get
        if ($validator->passes()) {
            if ($request->file('image')) {
                if ($img->image) {
                   unlink($img->image);
                }
                $image = $request->file('image');
                $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension(); // 343434.png
                Image::make($image)->resize(400,400)->save('images/product/'.$name_gen);
                $save_url = 'images/product/'.$name_gen;
            }else{
              $save_url =$img->image;
            }
            Purchase::findOrFail($request->id)->update([
                'name' => $request->name,
                'image' => $save_url,
                'quantity' => $request->quantity,
                'amount' => $request->amount,
                'note' => $request->note,
                'created_by' =>  $request->user_id,
                'date' => $request->date,
            ]);
             return response()->json(['success'=>1]);
        }else{
            return response()->json([$validator->errors()]);
        }

    }

    public function purchasesRemove($id)
    {
        $img=DB::table('purchases')->where('id',$id)->first();
        if($img->image){
            unlink($img->image);
        }
        Purchase::findOrFail($id)->delete();
    }





}

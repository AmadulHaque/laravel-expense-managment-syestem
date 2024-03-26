<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Image,File,DB;
use Illuminate\Support\Facades\Auth;
use App\Models\{Category,Transaction};
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{

    public function TransactionAll(Request $request)
    {
      if ($request->ajax()) {
            $search = @$request->search;
            $perPage = @$request->perPage ? $request->perPage : 10;
            $data=Transaction::orderBy('id', 'desc');
            if($request->search){
                $data->where('tag', 'like', '%'.$request->search.'%')
                ->orWhere('note', 'like', '%'.$request->search.'%')
                ->orWhere('date', 'like', '%'.$request->search.'%')
                ->orWhere('amount', 'like', '%'.$request->search.'%');
            }
            if ($request->date) {
                $formattedDate = date('Y-m-d', strtotime($request->date));
                $data->whereDate('date', $formattedDate);
            }
            if ($request->type) {
                $categoryType = $request->type;
                $categoryId = Category::where('type', $categoryType)->pluck('id');
                $data->whereIn('category_id', $categoryId);
            }
            $amount = $data->sum('amount');
            $datas = $data->paginate($perPage);
            return view('backend.components.transactions.table',compact('datas','amount'));
        }
        $category =Category::all();
        return view('backend.pages.transactions.index',compact('category'));
    }

    public function TransactionStore(Request $request)
    {
      $validator =  Validator::make($request->all(), [
          'category_id' => 'required',
          'amount' => 'required',
          'note' => 'required',
          'date' => 'required',
      ]);
      if ($validator->passes()) {
            Transaction::insert([
              'category_id' => $request->category_id,
              'amount' => $request->amount,
              'note' => $request->note,
              'date' => $request->date,
              'status' =>'1',
              'created_by'=> Auth::user()->id,
              'created_at' => Carbon::now(),
            ]);
           return response()->json(['success'=>1]);
        }else{
             return response()->json([$validator->errors()]);
         }
    }

    public  function TransactionEdit($id)
    {
        $category =Category::all();
        $data = Transaction::findOrFail($id);
        return view('backend.components.transactions.edit',compact('data','category'));
    }

    public function TransactionUpdate(Request $request){
      $validator =  Validator::make($request->all(), [
        'category_id' => 'required',
        'amount' => 'required',
        'note' => 'required',
        'date' => 'required',
      ]);
      if ($validator->passes()) {
            Transaction::findOrFail($request->id)->update([
                'category_id' => $request->category_id,
                'amount' => $request->amount,
                'note' => $request->note,
                'date' => $request->date,
                'status' =>'1',
                'created_by'=> Auth::user()->id,
                'created_at' => Carbon::now(),
           ]);
           return response()->json(['success'=>1]);
        }else{
             return response()->json([$validator->errors()]);
        }
    }

    public function TransactionRemove($id)
    {
        Transaction::findOrFail($id)->delete();
    }
}

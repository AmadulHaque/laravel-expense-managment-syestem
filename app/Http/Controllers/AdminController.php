<?php

namespace App\Http\Controllers;

use Image,DB;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\{Category, User,InvoiceDetail, Purchase};

class AdminController extends Controller
{

    public function adminLogout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    public function adminDashboard()
    {
        $pur_total_amount = Purchase::sum('amount');
        $pur_today_amount = Purchase::whereDate('date',date('Y-m-d'))->sum('amount');

        $incomeId = Category::where('type','income')->pluck('id');
        $expenseId = Category::where('type','expense')->pluck('id');

        $inc_total_amount = Transaction::whereIn('category_id', $incomeId)->sum('amount');
        $inc_today_amount = Transaction::whereIn('category_id', $incomeId)->whereDate('date',date('Y-m-d'))->sum('amount');

        $exp_total_amount = Transaction::whereIn('category_id', $expenseId)->sum('amount');
        $exp_today_amount = Transaction::whereIn('category_id', $expenseId)->whereDate('date',date('Y-m-d'))->sum('amount');

        $users = User::count();
        return view('backend.index',get_defined_vars());
    }

    public function adminProfile()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('backend.components.profile.index',compact('user'));
    }

    public function AdminProfileUpdate(Request $request)
    {
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;

        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('images/profile/'.$data->photo));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('images/profile/'),$filename);
            $data['photo'] = 'images/profile/'.$filename;
        }

        $data->save();
        $notification = array(
            'message' => 'Admin Profile Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function AdminChangePassword(){
        return view('backend.components.profile.setting');
    }


  public function AdminUpdatePassword(Request $request){
        // Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        // Match The Old Password
        if (!Hash::check($request->old_password, auth::user()->password)) {
            return back()->with("error", "Old Password Doesn't Match!!");
        }

        // Update The new password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)

        ]);
        return back()->with("status", " Password Changed Successfully");

    } // End Mehtod


}

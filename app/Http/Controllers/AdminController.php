<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Enums\TxnType;
use App\Enums\TxnStatus;
// use Spatie\Permission\Models\Role;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Middleware\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;

class AdminController extends Controller
{
    public function AdminLogin()
    {



        return view('admin.admin_login');
    }
    //admin dashboard
    public function AdminDashboard()
    {
        $transaction = new Transaction();
        $transactData = Transaction::orderBy('created_at', 'desc')->take(10)->get();
        $user = new User();

        $latestUser = $user->latest()->take(5)->get();


        $latestInvest = Transaction::orderBy('created_at', 'desc')->take(5)->get();

        $depositCount = $transaction->where(function ($query) {
            $query->where('type', TxnType::Investment)
                ->where('status', 'success');
        })->count(); // counts number of invested users

        $totalInvestment = $transaction->where('status', TxnStatus::Success)->where(function ($query) {
            $query->where('type', TxnType::Investment);
        }); // sum of investment amount

        $payoutCount = $transaction->where(function ($query) {
            $query->where('type', TxnType::Withdraw)
                ->where('status', 'success');
        })->count();

        $data = [
            'payout_count' => $payoutCount,
            'deposit_count' => $depositCount,
            'users_name' => $user,
            'register_user' => $user->count(),
            'transactions_data' => $transactData,
            // 'active_user' => $activeUser,
            'latest_user' => $latestUser->count(),
            'latest_username' => $latestUser,
            // 'latest_invest' => $latestInvest,

            // 'total_staff' => $totalStaff,

            // 'total_deposit' => $totalDeposit->sum('amount'),
            // 'total_send' => $totalSend,
            'total_investment' => $totalInvestment->sum('invest_amount'),
            // 'total_withdraw' => $totalWithdraw,
            // 'total_referral' => $totalReferral,

            // 'last7days_deposit' => $last7daysDeposit,
            // 'last7days_invest' => $last7daysInvest,

            // 'deposit_bonus' => $transaction->totalDepositBonus(),
            // 'investment_bonus' => $transaction->totalInvestBonus(),
            // 'total_gateway' => $totalGateway,
            // 'total_ticket' => Ticket::count(),

            // 'date_range' => $dataRange,

        ];
        // return view('admin.index');// old
        return view('backend.dashboard', compact('data', 'transactData'));
    }

    public function AdminDestroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array(
            'message' => 'User logged out successfully',
            'alert-type' => 'success'
        );

        return redirect('/admin/login')->with($notification);
    }
    public function AdminProfile()
    {
        $id = Auth::user()->id;
        $adminData = User::find($id);
        return view('admin.admin_profile_view', compact('adminData'));
    }

    public function EditProfile()
    {
        $id = Auth::user()->id;
        $editData = User::find($id);
        return view('admin.admin_profile_edit', compact('editData'));
    }

    //
    public function AdminProfileStore(Request $request)
    {

        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;


        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/admin_images/' . $data->photo));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'), $filename);
            $data['photo'] = $filename;
        }

        $data->save();

        $notification = array(
            'message' => 'Admin Profile Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } // End Method

    //
    public function AdminChangePassword()
    {

        return view('admin.admin_change_password');
    } // End Method
    public function UpdateHome()
    {

        return view('admin.Home.testing');
    } // End Method


    public function AdminUpdatePassword(Request $request)
    {
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
    } // End Method 






    ///////////// Admin All Method //////////////


    public function AllAdmin()
    {
        $alladminuser = User::where('role', 'admin')->latest()->get();
        return view('backend.admin.all_admin', compact('alladminuser'));
    } // End Mehtod 


    // public function AddAdmin()
    // {
    //     $roles = Role::all();
    //     return view('backend.admin.add_admin', compact('roles'));
    // } // End Method 



    public function AdminUserStore(Request $request)
    {

        $user = new User();
        $user->username = $request->username;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->password = Hash::make($request->password);
        $user->role = 'admin';
        $user->status = 'active';
        $user->save();

        if ($request->roles) {
            $user->assignRole($request->roles);
        }

        $notification = array(
            'message' => 'New Admin User Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.admin')->with($notification);
    } // End Method 




    // public function EditAdminRole($id)
    // {

    //     $user = User::findOrFail($id);
    //     $roles = Role::all();
    //     return view('backend.admin.edit_admin', compact('user', 'roles'));
    // } 
    // End Method 


    public function AdminUserUpdate(Request $request, $id)
    {


        $user = User::findOrFail($id);
        $user->username = $request->username;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->role = 'admin';
        $user->status = 'active';
        $user->save();

        $user->roles()->detach();
        if ($request->roles) {
            $user->assignRole($request->roles);
        }

        $notification = array(
            'message' => 'New Admin User Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.admin')->with($notification);
    } // End Method 


    public function DeleteAdminRole($id)
    {

        $user = User::findOrFail($id);
        if (!is_null($user)) {
            $user->delete();
        }

        $notification = array(
            'message' => 'Admin User Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } // End Method 

}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $user_id = auth()->user()->id;
        $user = DB::select(
            /** @lang text */
            "select * from users where id = '$user_id'"
        );
        $requests = DB::select(
            /** @lang text */
            "select * from request_admins"
        );
        return view('list_admin_request')->with(['user' => $user, 'requests' => $requests]);
    }

    public function decideRequest(Request $request)
    {
        if ($request->reject) {
            $requestid = $request->request_id;
            DB::table('request_admins')->where('request_id', $requestid)->delete();
            return redirect('/account/list_admin_requests');
        } else {
            $userid = $request->user_id;
            $requestid = $request->request_id;
            $username = $request->username;
            $email = $request->user_email;

            DB::update("update users set role = 'admin' where id = '$userid' and name = '$username' and email = '$email'");
            DB::table('request_admins')->where('request_id', $requestid)->delete();
            return redirect('/account/list_admin_requests');
        }
    }

    public function users()
    {
        $users = DB::table('users')->select('*')->get();
        return view('users', ['users' => $users]);
    }

    public function promoteAdmin(Request $request)
    {
        $uid = $request->uid;
        $permission = $request->permission;

        if ($permission == 'remove-admin') {
            User::where('id', $uid)->update(['role' => 'member']);
            return redirect()->back();
        } elseif ($permission == 'promote-admin') {
            User::where('id', $uid)->update(['role' => 'admin']);
            return redirect()->back();
        }
    }

    public function deleteuseraccount(Request $request)
    {
        $uid = $request->uid;
        DB::table('users')->where('id', $uid)->delete();
        return redirect()->back();
    }
}

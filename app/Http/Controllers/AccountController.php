<?php

namespace App\Http\Controllers;

use App\Models\RequestAdmin;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \Illuminate\Support\Facades\Session;

class AccountController extends Controller
{
    public function index()
    {
        $user_id = auth()->user()->id;
        $user = DB::select(/** @lang text */ "select * from users where id = '$user_id'");
        return view('account')->with(['user' => $user]);
    }

    public function uploadProfilePhoto(Request $request)
    {
        $profile_photo = $request->file('profile_photo');
        $photo_name = $profile_photo->getClientOriginalName();
        $user_id = auth()->user()->id;

        $profile_photo->storeAs('/public/images', $photo_name);
        DB::update(/** @lang text */ "update users set profile_photo = '$photo_name' where id = '$user_id'");
        return redirect()->to('/account');
    }

    public function saveChanges(Request $request)
    {
        $address = $request->address;
        $user_id = auth()->user()->id;
        DB::update(/** @lang */ "update users set address = '$address' where id = '$user_id'");
        return redirect()->to("/account")->with(['changes_success' => 'Profile updated successfully']);
    }

    public function requestAdminAccess()
    {
        $user_id = auth()->user()->id;
        $request = DB::select(/** @lang text */ "select * from request_admins where user_id = '$user_id'");
        if ($request != null) {
            return redirect()->to('/account')->with(['request_exists' => 'You have already requested!'])->with(['request_pending' => 'Your request is pending to be approved']);
        } else {
            $user = DB::select(/** @lang text */ "select * from users where id = '$user_id'");

            $request = new RequestAdmin();
            $request->request_id = rand(1000, 3000);
            $request->user_id = $user_id;
            $request->username = $user[0]->name;
            $request->user_email = $user[0]->email;
            $request->requested_at = Carbon::now()->toDateTimeString();
            $request->save();
            return redirect()->to('/account')->with(['success_request' => 'Your request has been placed successfully']);
        }
    }

    public function deleteAccount()
    {
        $user_id = auth()->user()->id;
        DB::table('users')->where(['id' => $user_id])->delete();
        return redirect('/login');
    }
}

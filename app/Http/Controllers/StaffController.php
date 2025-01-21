<?php

namespace App\Http\Controllers;

use App\Helper\Killa;
use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StaffController extends Controller
{

    public function viewAdminManage()
    {
        $users = User::all();
        return Killa::responseSuccessWithMetaAndResult(200, 1, 'Success', $users);
    }

    public function viewAdminEdit($id)
    {
        $users = User::where('id', '=', $id)->first();
        $address = UserAddress::where('id_user', '=', $users->id)->first();
        return Killa::responseSuccessWithMetaAndResult(200, 1, 'Success', ['users' => $users, 'address' => $address]);
    }

    function destroy($id)
    {
        $user = User::findOrFail($id);
        if ($user->delete()) {
            return Killa::responseSuccessWithMetaAndResult(200, 1, "Successfully deleted user $user->name", []);
        } else {
            return Killa::responseErrorWithMetaAndResult(400, 0, "Failed to delete user", []);
        }
    }

    function store(Request $request)
    {
        $validateComponent = [
            "user_name" => "required",
            "user_email" => "required",
            "user_password" => "required",
            "user_role" => "required",
        ];

        $this->validate($request, $validateComponent);

        $user = new User();
        $user->name = $request->user_name;
        $user->email = $request->user_email;
        $user->contact = $request->user_contact;
        $user->password = bcrypt($request->user_password);
        $user->role = ($request->user_role);

        if ($user->save()) {
            $address = new UserAddress();
            $address->id_user = $user->id;
            $address->address = $request->address;
            $address->save();

            return Killa::responseSuccessWithMetaAndResult(200, 1, "Successfully added new user", []);
        } else {
            return Killa::responseErrorWithMetaAndResult(400, 0, "Failed to add new user", []);
        }
    }

    function update(Request $request)
    {
        $validateComponent = [
            "user_name" => "required",
            "user_email" => "required",
            "user_role" => "required",
        ];

        $this->validate($request, $validateComponent);

        $user = User::findOrFail($request->id);
        $user->name = $request->user_name;
        $user->email = $request->user_email;
        $user->contact = $request->user_contact;
        $user->password = bcrypt($request->user_password);
        $user->role = ($request->user_role);

        if ($request->address_id == null) {
            $address = new UserAddress();
            $address->id_user = $user->id;
            $address->address = $request->address;
            $address->save();
        } else {
            $address = UserAddress::find($request->address_id);
            $address->id_user = $user->id;
            $address->address = $request->address;
            $address->save();
        }

        if ($user->save()) {
            return Killa::responseSuccessWithMetaAndResult(200, 1, "Successfully updated user data", []);
        } else {
            return Killa::responseErrorWithMetaAndResult(400, 0, "Failed to update user data", []);
        }
    }
}

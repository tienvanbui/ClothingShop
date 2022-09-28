<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\uploadFileImage;
use Illuminate\Http\Request;
class ProfileController extends Controller
{
    use uploadFileImage;
    public function __construct()
    {
        $this->setModel(User::class);
        $this->resourceName = 'users';
        $this->modelName = 'User';
        $this->views = [
            'index' => 'admin.profile.index'
        ];
        $this->validateRule = [
            'name' => 'bail|string|required|max:30|min:10',
            'email' => 'required|email|bail',
            'username' => 'required|alpha_dash|max:30|bail',
            'avatar' => 'required',
            'phoneNumber' => 'required|bail',
            'address' => 'required|string'
        ];
    }
    public function update(Request $request)
    {
        if ($this->startValidationProcess($request)) {
            $data = $this->uploadAvataruser($request);
            if (!empty($data)) {
                $dataUpdateAvatar['avatar'] = $data['file_path'];
                User::find(auth()->user()->id)->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'username' => $request->username,
                    'avatar' => $dataUpdateAvatar['avatar'],
                    'phoneNumber' => $request->phoneNumber,
                    'address' => $request->address,
                    'role_id' => auth()->user()->id
                ]);
                return redirect()->route('profile.index')->with('toast_success', "$this->modelName Updated Successfully!");
            }
            return redirect()->route('profile.index')->with('toast_error', 'Woops,something is wrong!');
        }
    }
}

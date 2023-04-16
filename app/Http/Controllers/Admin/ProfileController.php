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
            'name' => 'required|max:30|min:10',
            'email' => 'required|email|bail',
            'username' => 'required|alpha_dash|max:30|bail',
            'avatar' => 'required',
            'phoneNumber' => 'required|numeric',
            'address' => 'required|max:255'
        ];
        $this->messageValidate = [
            'name.required' => 'Trường này không được để trống',
            'email.required' => 'Trường này không được để trống',
            'username.required' => 'Trường này không được để trống',
            'avatar.required' => 'Trường này không được để trống',
            'phoneNumber.required' => 'Trường này không được để trống',
            'phoneNumber.numeric' => 'Trường này phải là số',
            'address.required' => 'Trường này không được để trống',
            'name.max' => 'Tối đa 30 ký tự',
            'address.max' => 'Tối đa 255 ký tự',
            'username.max' => 'Tối đa 30 ký tự',
            'username.min' => 'Tối thiếu 10 ký tự',
        ];
    }
    public function update(Request $request)
    {
        if ($this->startValidationProcess($request,$this->messageValidate)) {
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
                return redirect()->route('profile.index')->with('toast_success', "Cập nhật thông tin thành công!");
            }
            return redirect()->route('profile.index')->with('toast_error', 'Có gì đó không đúng!');
        }
    }
}

<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\uploadFileImage;

class ProfileController extends Controller
{
    use uploadFileImage;
    public function __construct()
    {
        $this->setModel(Cart::class);
        $this->getAppMenu();
        $this->validateRule = [
            'name' => 'bail|string|required|max:30|min:10',
            'email' => 'required|email|bail',
            'username' => 'required|max:30|bail',
            'phoneNumber' => 'required|numeric',
            'address' => 'required|max:255'
        ];
        $this->messageValidate = [
            'name.required' => 'Trường này không được để trống',
            'name.max' => 'Tối đa 30 ký tự',
            'name.min' => 'Tối thiểu 10 ký tự',
            'username.required' => 'Trường này không được để trống',
            'username.max' => 'Tối đa 30 ký tự',
            'address.required' => 'Trường này không được để trống',
            'address.max' => 'Tối đa 255 ký tự',
            'email.required' => 'Trường này không được để trống',
            'email.email' => 'Phải có định dạng email',
            'phoneNumber.required' => 'Trường này không được để trống',
            'phoneNumber.numeric' => 'Trường này phải là định dạng số',
           
        ];
    }
    public function getPrivateInfo()
    {
        return view('user.profile.edit')
            ->with('menus', $this->menus)
            ->with('cart', $this->cartOfUser)
            ->with('totalPrice', $this->totalPriceOfAllProductInCart)
            ->with('countCartProduct', $this->countCartItem);
    }
    public function update(Request $request)
    {
        if ($this->startValidationProcess($request,$this->messageValidate)) {
            $data = $this->uploadAvataruser($request);
            if(!empty($data)){
                $dataUpdateAvatar['avatar'] = $data['file_path'];
            }
            User::find(auth()->user()->id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'username' => $request->username,
                'avatar' => !empty($dataUpdateAvatar['avatar']) ? $dataUpdateAvatar['avatar'] : auth()->user()->avatar,
                'phoneNumber' => $request->phoneNumber,
                'address' => $request->address,
                'role_id' => auth()->user()->id
            ]);
            return redirect()->route('user.my-profile')->withToastSuccess("Cập nhật tài khoản thành công!");
        }
        return redirect()->route('user.my-profile')->withToastError('Có lỗi gì đó không ổn!');
    }
}

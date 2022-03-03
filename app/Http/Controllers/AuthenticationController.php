<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\http\Requests\AuthenticationRegisterRequest;
use App\http\Requests\AuthenticationPasswordRequest;
use App\Http\Requests\AuthenticationProfileRequest;
use App\Http\Requests\AuthenticationLoginRequest;
use App\Http\Requests\AuthenticationResetRequest;
use App\Http\Requests\AuthenticationEmailRequest;
use App\Jobs\MailSend;
use App\Models\Countries;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AuthenticationController extends Controller
{
    //
    public function registerForm()
    {
        return view('authentication.register');
    }

    public function registerFormSubmit(AuthenticationRegisterRequest $request)
    {
        $request->validated();

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = md5($request->password_confirmation);
        $user->status = 0;
        $rand = rand();
        $token = md5($rand);
        $user->remember_token = $token;
        $user->save();
        $user->roles()->attach(1);
        $user->assignRole('user');
        $url = url('/verify', $token);
        // MailSend::dispatch($url,$user->email)->delay(now()->addSeconds(1));

        return redirect(route('registerForm'))->with("success", 'Your registration has been successfully completed,Please verify your email');
    }

    public function loginForm()
    {
        return view('authentication.login');
    }

    public function loginFormSubmit(AuthenticationLoginRequest $request)
    {
        $request->validated();
        $user = User::where('email', $request->email)->first();
        if ($user !== null)
        {
            if ($user->password === md5($request->password))
            {
                if ($user->status === 1)
                {
                    \Auth::login($user);

                    return redirect(route('dashboard'))->with("success", 'Your login has been successfully completed');
                }
                return redirect(route('loginForm'))->with("info", 'Please verify your email');
            }
            return redirect(route('loginForm'))->with("error", 'Your password has been invalid');
        }
        return redirect(route('loginForm'))->with("error", 'Your email has been invalid');
    }

    public function Logout()
    {
        Auth::logout();
        return redirect(route('loginForm'))->with("success", 'Your account logout successfully');
    }

    public function forgotPasswordForm()
    {
        return view('authentication.forgot_password');
    }

    public function forgotPasswordFormSubmit(AuthenticationEmailRequest $request)
    {
        $request->validated();

        $status = Password::sendResetLink(
            $request->only('email')
        );
        return $status === Password::RESET_LINK_SENT
            ? back()->with(['success' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    public function ResetPasswordForm($token, Request $request)
    {
        return view('authentication.recover_password', ['email' => $request->email, 'token' => $token])->with('success', 'Your email has been successfully verirfy');
    }

    public function ResetPasswordFormSubmit(AuthenticationResetRequest $request)
    {
        $request->validated();

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => md5($password),
                    'status' => 1,
                ])->setRememberToken(Str::random(2));

                $user->save();
                \Auth::login($user);

            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('dashboard')->with('success', __($status))
            : back()->withErrors(['password' => [__($status)]]);
    }

    public function verify($token)
    {
        $user = User::where('remember_token', $token)->first();
        User::where('remember_token', $token)->update(['remember_token' => null, 'status' => 1]);

        if ($user != null)
        {
            \Auth::login($user);

            return redirect(route('dashboard'))->with('success', 'Your email has been successfully verirfy');
        }
        return redirect(route('loginForm'))->with("error", 'Your token has been invalid');
    }

    public function ChangePasswordForm()
    {
        return view('authentication.change_password');
    }

    public function ChangePasswordFormSubmit(AuthenticationPasswordRequest $request)
    {
        $request->validated();

        $email = Auth::user()->email;
        $user = User::where('email', $email)->first();

        if ($user != null)
        {
            if ($user->password === md5($request->oldPassword) && $user->status === 1)
            {
                User::where('email', $email)->update(['password' => md5($request->password_confirmation)]);
                $userNewData = User::where('email', $email)->first();
                \Auth::login($userNewData);

                return redirect(route('dashboard'))->with('success', 'your account password successfully changed');
            }
            return redirect(route('ChangePasswordForm'))->with("error", 'Your password has been invalid');
        }
        return redirect(route('ChangePasswordForm'))->with("error", 'Your email has been invalid');
    }


    public function profileFrom()
    {
        $countries  = Countries::all();
        $user = User::find(Auth::user()->id);

        return view('authentication.profile', compact('user', 'countries'));
    }


    public function profileFormSubmit(AuthenticationProfileRequest $request)
    {
        $request->validated();

        $user =  User::find($request->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->gender = $request->gender;
        $hobbies = $request->input('hobbies');
        $hobbies = implode(",", $hobbies);
        $user->hobbies = $hobbies;
        $user->state_id = $request->stateId;
        $user->countrie_id = $request->countrieId;
        $user->city = $request->city;
        if ($request->image !== null)
        {
                $imageName = $request->file('image');
                $newName =  'profile_' . $user->id . '.' . $imageName->getClientOriginalExtension();
                $imageName->move(public_path('storage\user'), $newName);
                $user->image = $newName;
        }

        $user->save();
        \Auth::login($user);

        return redirect(route('dashboard'))->with('success', 'Your profile update successfully');
    }
}

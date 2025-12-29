<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;



class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
         $this->app->singleton(
        LogoutResponse::class,
        CustomLogoutResponse::class
    );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {   

          Fortify::registerView(function () {
        return view('register');
          });

         Fortify::loginView(function () {
        return view('login');
           });

         Fortify::authenticateUsing(function (Request $request) {

            // ① バリデーション（FN019 a / b）
            Validator::make(
                $request->all(),
                [
                    'email' => ['required', 'email'],
                    'password' => ['required'],
                ],
                [
                    'email.required' => 'メールアドレスを入力してください',
                    'email.email'    => 'メールアドレスはメール形式で入力してください',
                    'password.required' => 'パスワードを入力してください',
                ]
            )->validate();

            // ② 認証チェック
            $user = User::where('email', $request->email)->first();

            if (! $user || ! Hash::check($request->password, $user->password)) {
                throw ValidationException::withMessages([
                    'login' => 'ログイン情報が登録されていません',
                ]);
            }

            return $user;
        });   

        Fortify::redirects('login', '/admin');
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.$request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
    }
}

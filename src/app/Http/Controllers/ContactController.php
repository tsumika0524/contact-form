<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;

class ContactController extends Controller
{
  public function index()
  {
    $categories = Category::all();
    return view('index', compact('categories'));
  }
  public function confirm(ContactRequest $request)
{
    $inputs = $request->except('_token');

    if (!isset($inputs['category_id'])) {
        $inputs['category_id'] = $request->category_id;
    }

    // 選択されたカテゴリ名を取得
    $categoryName = Category::find($inputs['category_id'])->content ?? 'その他';


    return view('confirm', compact('inputs', 'categoryName'));
}

    public function create()
{
    // categories テーブルから全データを取得
    $categories = Category::all();

    // フォームビューに渡す
    return view('contacts.create', compact('categories'));
}
  public function store(ContactRequest $request)
{


     $categoryName = Category::find($request->category_id)->content ?? 'その他';

    Contact::create([
        'last_name' => $request->last_name,
        'first_name' => $request->first_name,
        'gender' => $request->gender,
        'email' => $request->email,
        'tel' => $request->tel1.'-'.$request->tel2.'-'.$request->tel3,
        'address' => $request->address,
        'building' => $request->building,
        'category_id' => $request->category_id,
        'category'   => $categoryName, // ← category_id から取得した文字列をセット
        'detail' => $request->content,
    ]);
    return redirect()->route('thanks');
}


    public function thanks()
    {
        return view('thanks');
    }


    public function register()
    {
        return view('register');
    }

    public function admin()
    {
        return view('admin.index');
    }
    

    public function login(LoginRequest $request)
    {
    $credentials = $request->only('email', 'password');

    if (!Auth::attempt($credentials)) {
        return back()->withErrors([
            'login' => 'ログイン情報が登録されていません',
        ]);
    }

    $request->session()->regenerate();
    return redirect()->intended(route('admin'));
}

}


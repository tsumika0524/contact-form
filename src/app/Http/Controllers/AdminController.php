<?php

namespace App\Http\Controllers;

use App\Models\Contact;

class AdminController extends Controller
{
    public function index()
    {
        $contacts = Contact::with('category')->latest()->paginate(7);


        return view('admin.index', compact('contacts'));
    }

    public function show($id)
    {
    $contact = Contact::with('category')->findOrFail($id);
    return view('admin.show', compact('contact'));
    }

    public function search(Request $request)
{
    $query = Contact::with('category');

    // 名前検索（姓・名・フルネーム）
    if ($request->filled('keyword')) {
        $keyword = $request->keyword;
        $query->where(function($q) use ($keyword) {
            $q->where('first_name', 'like', "%{$keyword}%")
              ->orWhere('last_name', 'like', "%{$keyword}%")
              ->orWhereRaw("CONCAT(first_name, last_name) LIKE ?", ["%{$keyword}%"])
              ->orWhereRaw("CONCAT(last_name, first_name) LIKE ?", ["%{$keyword}%"]);
        });
    }

    // メールアドレス検索（部分一致・全部一致）
    if ($request->filled('keyword')) {
        $keyword = $request->keyword;
        $query->orWhere('email', 'like', "%{$keyword}%");
    }

    // 性別検索
    if ($request->filled('gender') && $request->gender !== '') {
        $query->where('gender', $request->gender);
    }

    // カテゴリー検索
    if ($request->filled('category_id')) {
        $query->where('category_id', $request->category_id);
    }

    // 日付検索
    if ($request->filled('date')) {
        $query->whereDate('created_at', $request->date);
    }

    // 結果をページネート
    $contacts = $query->latest()->paginate(7)->withQueryString();

    return view('admin.index', compact('contacts'));
}








}

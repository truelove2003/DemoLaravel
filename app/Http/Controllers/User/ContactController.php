<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        // Lấy tất cả các liên hệ từ cơ sở dữ liệu
        $contacts = Contact::all();

        // Trả về view và truyền dữ liệu liên hệ
        return view('admin1.table-contact', compact('contacts'));
    }

    // Hiển thị form liên hệ
    public function showForm()
    {
        return view('User.form-contact'); // Đảm bảo rằng bạn có view 'contact.blade.php'
    }

    // Xử lý dữ liệu từ form liên hệ
    public function store(Request $request)
    {
        // Validate dữ liệu từ form
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Lưu dữ liệu liên hệ vào cơ sở dữ liệu
        Contact::create($request->all());

        return redirect()->route('contact.show')->with('success', 'Your message has been sent successfully!');
    }
}

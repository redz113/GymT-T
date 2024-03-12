<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use http\Env\Response;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $new = new Contact();
        $new->name = $request->name;
        $new->email = $request->email;
        $new->phone = $request->phone;
        $new->description = $request->description;
        $new->save();
        return response()->json([
            'status' => 200,
            'message' => 'Nội dung của bạn đã được gửi. Hãy check gmail chúng tôi sẽ liên hệ sớm nhất !'
        ]);
    }
}

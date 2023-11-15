<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Codes;
use App\Models\Transactions;

class UserController extends Controller
{
    public function __construct()
    {}

    public function index()
    {
        $data = User::where('is_admin', '0')->orderBy('id', 'DESC')->get();
        return view('admin.users.index', compact('data'));
    }
}

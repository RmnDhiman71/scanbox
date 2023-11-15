<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Configuration;

class ConfigController extends Controller
{
    public function __construct()
    {}

    public function index()
    {
        return view('admin.config.index');
    }
}

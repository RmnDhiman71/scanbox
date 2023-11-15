<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Codes;
use App\Models\Batch;
use \Milon\Barcode\DNS2D;

class BarCodeController extends Controller
{
    public function __construct()
    {}

    public function index()
    {
        $data = Codes::orderBy('id', 'DESC')->get();
        return view('admin.barcode.index', compact('data'));
    }

    public function batches()
    {
        $data = Batch::orderBy('id', 'DESC')->get();
        return view('admin.barcode.batch', compact('data'));
    }

    public function add()
    {
        return view('admin.barcode.add');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if($request->type == '2')
        {
            $validator = Validator::make($request->all(), [
                'bar_code' => 'required|unique:codes',
                'description' => 'required'
            ]);
    
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput()->with('type', $request->type);
            }
        }
        
        $count = !empty($request->count) ? $request->count : 1;

        if($request->type == '1')
        {
            $validator = Validator::make($request->all(), [
                'validity' => 'required',
                'valid_for' => 'required',
                'amount' => 'required|integer',
                'currency' => 'required',
                'count' => 'integer'
            ]);
    
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput()->with('type', $request->type);
            }
        }
        
        if($request->type == 1)
        {
            $batch = new Batch();
            $batch->description = $request->description;
            $batch->amount = $request->amount;
            $batch->currency = $request->currency;
            $batch->validity = $request->validity;
            $batch->valid_for = $request->valid_for;
            $batch->save();
            $batch->number = 'BATCH_'.$batch->id;
            $batch->update();
            
            for($i=1; $i <= $count; $i++)
            {
                $bar_code = $this->generateCode(16, 'bar_code', 1);
                $scratch_code = $this->generateCode(8, 'scratch_code', 2);

                $codes = new Codes;
                $codes->type = $request->type;
                $codes->batch_id = $batch->id;
                $codes->bar_code = $bar_code;
                $codes->description = $request->description;
                $codes->validity = $request->validity;
                $codes->valid_for = $request->valid_for;
                $codes->amount = $request->amount;
                $codes->currency = $request->currency;
                $codes->scratch_code = $scratch_code;

                $codes->save();
            }
        }

        if($request->type == 2)
        {
            $codes = new Codes;
            $codes->type = $request->type;
            $codes->bar_code = $request->bar_code;
            $codes->description = $request->description;
            $codes->save();
        }

        return redirect('barcode')->with('success', 'Code Created Successfully ...!!');
    }
    
    public function list()
    {
        $data = Codes::where('type', '1')->where('is_active', 0)->orderBy('id', 'DESC')->get();
        return view('admin.barcode.list', compact('data'));
    }

    public function batchList(Batch $batch)
    {
        $data = Codes::where('type', '1')->where('is_active', 0)->where('batch_id', $batch->id)->orderBy('id', 'DESC')->get();
        return view('admin.barcode.list', compact('data'));
    }

    public function destroy(Batch $batch)
    {
        $batch->delete();
        return redirect()->back()->with('success', 'Batch Deleted Successfully ... !!!');
    }

    public function update(Batch $batch)
    {
        $batch->is_deleteable = 0;
        $batch->update();
        return redirect()->route('batches-list', $batch->id);
    }

    public function generateCode($length, $key, $type = 1)
    {
        $characters = ($type == 1) ? '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz' : '0123456789';
        $random = '';

        for ($i = 0; $i < $length; $i++) {
            $random .= $characters[rand(0, strlen($characters) - 1)];
        }

        $code = Codes::where($key, $random)->first();

        if(!empty($code))
        {
            $this->generateCodegenerateCode($length, $key);
        }

        return $random;
    }
}
<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index(){
        $packages = Package::where('id', '>',0)->get();
        return response()->json([
            'status'=>200,
            'data'=>$packages
        ]);
    }

    public function show($id){
        $package = Package::where('id', $id)->first();
        if($package !=null){
           return response()->json([
                'status'=>200,
                'data'=>$package
            ]);
        }
        return response()->json([
            'status'=>404,
        ]);
    }
}

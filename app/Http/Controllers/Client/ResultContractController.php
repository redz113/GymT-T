<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\ResultContract;
use Illuminate\Http\Request;

class ResultContractController extends Controller
{
    public function resultPackage($result){
        $result = ResultContract::find($result);
        return view('screens.frontend.account.result-package',['result' => $result]);
    }

    public function evaluateMember($result){
        $result = ResultContract::find($result);
        
        return view('screens.frontend.accountCoach.evaluate-member',['result' => $result]);
    }

    public function postEvaluateMember($result, Request $request){
        $result = ResultContract::find($result);
        $result->height = $request->height;
        $result->weight = $request->weight;
        // dd($request->weight/($request->height*$request->height));
        $result->bmi = $request->weight/(($request->height/100)*($request->height/100));
        // dd($request->height/100);
        $result->comment = $this->test_bmi($request->weight/(($request->height/100)*($request->height/100)));
        $result->status_package = 1;
        $result->save();

        return back()->with('msg','Cập nhật thành công');
    }
    
    function test_bmi($bmi){
        $health = 0;
        if($bmi<16){
            $health ='Gầy độ III';
        }else if($bmi<17){
            $health ='Gầy độ II';
        }else if($bmi<18.5){
            $health ='Gầy độ I';
        }else if($bmi<25){
            $health ='Bình thường';
        }else if($bmi<30){
            $health ='Thừa cân';
        }else if($bmi<35){
            $health ='Béo phì độ I';
        }else if($bmi<40){
            $health ='Béo phì độ II';
        }else{
            $health ='Béo phì độ III';
        }
        return $health;
    }
}

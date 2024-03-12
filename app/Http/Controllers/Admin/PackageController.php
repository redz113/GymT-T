<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PackageRequest;
use App\Http\Requests\SubjectRequest;
use App\Models\Package;
use App\Models\Subject;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Utility\PackageUtility;
use App\Models\Rate;
use http\Env\Response;
use Illuminate\Http\Request;
use File;

class PackageController extends Controller
{
    public function index_primary(Request $request)
    {
        if (isset($request->subject_id)) {
            if (isset($request->status)) {
                $packages = Package::select('packages.*')
                    ->where('subject_id', $request->subject_id)
                    ->where('status', $request->status)
                    ->orderBy('created_at', 'desc');
            } else {
                $packages = Package::select('packages.*')
                    ->where('subject_id', $request->subject_id)
                    ->orderBy('created_at', 'desc');
            }
        } else {
            if (isset($request->status)) {
                $packages = Package::select('packages.*')
                    ->where('status', $request->status)
                    ->orderBy('created_at', 'desc');
            } else {
                $packages = Package::select('packages.*')
                    ->orderBy('created_at', 'desc');
            }
        }
        $cate_package = 1;
        $packages =  $packages->where('set_pt', 0)->paginate(12);
        return view('screens.backend.package.index', compact('packages', 'cate_package'));
    }

    public function index_pt(Request $request)
    {
        if (isset($request->subject_id)) {
            if (isset($request->status)) {
                $packages = Package::select('packages.*')
                    ->where('subject_id', $request->subject_id)
                    ->where('status', $request->status)
                    ->orderBy('created_at', 'desc');
            } else {
                $packages = Package::select('packages.*')
                    ->where('subject_id', $request->subject_id)
                    ->orderBy('created_at', 'desc');
            }
        } else {
            if (isset($request->status)) {
                $packages = Package::select('packages.*')
                    ->where('status', $request->status)
                    ->orderBy('created_at', 'desc');
            } else {
                $packages = Package::select('packages.*')
                    ->orderBy('created_at', 'desc');
            }
        }
        $cate_package = 2;
        $packages =  $packages->where('set_pt', 1)->paginate(12);
        return view('screens.backend.package.index', compact('packages', 'cate_package'));
    }

    public function create()
    {
        $subjects = Subject::all();
        $type_package = PackageUtility::$arrayPackage;
        return view('screens.backend.package.create', compact('subjects', 'type_package'));
    }

    public function store(PackageRequest $request)
    {
        // dd($request->avatar);
        $new = new Package();
        $new->package_name = $request->package_name;
        $new->subject_id = $request->subject_id;
        if ($request->avatar) {
            upload_image('avatar', $request->avatar, $new, 'images/package');
        }
        $new->short_description = $request->short_description;
        $new->price = $request->price;
        if ($request->price_sale) {
            $new->price_sale = $request->price_sale;
        }

        $new->into_price = $request->price - ($request->price * $new->price_sale / 100);
        $new->description = $request->description;
        $new->type_package = $request->type_package;
        if ($request->set_pt == 'on') {
            $new->set_pt = 1;
            $new->total_session_pt = $request->total_session_pt;
            $new->week_session_pt = $request->week_session_pt;
        }
        $new->save();
        Toastr::success('Thêm mới gói tập thành công');
        if($request->type_package == 1){
            return redirect()->route('admin.package.index_primary');
        }else{
            return redirect()->route('admin.package.index_pt');
        }

        return redirect()->back();
    }

    public function edit($id)
    {
        $type_package = PackageUtility::$arrayPackage;
        $package = Package::where('id', $id)->first();
        if ($package != null) {
            $subjects = Subject::where('id', '!=', $package->subject_id)->get();
            return view('screens.backend.package.edit', compact('package', 'subjects', 'type_package'));
        }
        return redirect()->back();
    }

    public function update(PackageRequest $request, $id)
    {
        $package = Package::where('id', $id)->first();
        $avtOld = $package->avatar;
        if ($package != null) {
            $package->package_name = $request->package_name;
            $package->subject_id = $request->subject_id;
            if ($request->avatar) {
                upload_image('avatar', $request->avatar, $package, 'images/package');
            }
            $package->price = $request->price;
            if ($request->price_sale) {
                $package->price_sale = $request->price_sale;
            }
            $package->type_package = $request->type_package;
            $package->into_price = $request->price - ($request->price * $package->price_sale / 100);
            $package->short_description = $request->short_description;
            $package->description = $request->description;

            if ($request->set_pt == 'on') {
                $package->set_pt = 1;
                $package->total_session_pt = $request->total_session_pt;
                $package->week_session_pt = $request->week_session_pt;
            } else {
                $package->set_pt = 0;
                $package->total_session_pt = null;
                $package->week_session_pt = null;
            }
            $package->save();
            if(File::exists(public_path($avtOld))){
                File::delete(public_path($avtOld));
            }
            Toastr::success('Cập nhật gói tập thành công');
            return redirect()->back();
        }
        if($request->type_package == 1){
            return redirect()->route('admin.package.index_primary');
        }else{
            return redirect()->route('admin.package.index_pt');
        }

        return redirect()->back();
       
    }

    public function change_status($id)
    {
        $package = Package::where('id', $id)->first();
        if ($package != null) {
            if ($package->status == 0) {
                $package->status = 1;
            } else {
                $package->status = 0;
            }
            $package->save();
            Toastr::success('Cập nhật trạng thái gói tập thành công');
            if($package->type_package == 1){
                return redirect()->route('admin.package.index_primary');
            }else{
                return redirect()->route('admin.package.index_pt');
            }
    
            return redirect()->back();
        }
        return redirect()->back();
    }

    public function evaluate($id){
        $evaluates = Rate::where('package_id', $id)->paginate(12);
        return view('screens.backend.package.evaluate', compact('evaluates'));
    }
}

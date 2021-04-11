<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StaffDetail;
use App\Models\Category;
use App\Models\Hobby;


class StaffDetailController extends Controller
{
    public function index()
    {
        $staffdetails = StaffDetail::all();
        $category = Category::all();
        $hobby = Hobby::all();
        return view('staff.index', ['staffdetails' => $staffdetails, 'category' => $category, 'hobby' => $hobby])->with('no', 1);
    }

    public function show()
    {
        
        return view('staff.add', ['category' => $category ]);
    }

    public function add(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' =>'required',
            'contact_no' => 'required',
            'category_id' => 'required|exists:App\Models\Category,id',
            'profile_pic' => 'required',
            'hobby' => "required|array"
        ]);
        $add = new StaffDetail;
        $add->name = $request->input('name');
        $add->contact_no = $request->input('contact_no');
        $add->category_id = $request->input('category_id');
        $add->save();
        $profile_pic = $request->file('profile_pic');
        $extension = $profile_pic->extension();
        if($extension=='jpg' || $extension=='png'){
            $pic_path = $profile_pic->storeAs('public/profile_pic', time().'.'.$extension);
        }
        $add->profile_pic = time().'.'.$extension;
        $add->save();
        for($i=0; $i < count($request->input('hobby')); $i++){
            $hobby = new hobby;
            $hobby->staff_detail_id = $add->id;
            $hobby->name = $request->input('hobby')[$i];
            $hobby->save();
        }
        return redirect()->back()->with('message', 'Success');            
    }

    public function edit($id)
    {
        $staffdetails = StaffDetail::find($id);
        // dd($staffdetails);
        $category = Category::all();
        return view('staff.edit', ['staffdetails' => $staffdetails, 'category' => $category]);
    }

    public function update(Request $request, $id)
    {
        $StaffDetail = StaffDetail::where('id', $id)->first();
        if(!empty($StaffDetail)){
            $StaffDetail->name = $request->input('name');
            $StaffDetail->contact_no = $request->input('contact_no');
            $StaffDetail->category_id = $request->input('category_id');
            if(!empty($request->file('profile_pic'))){
                
                $profile_pic = $request->file('profile_pic');
                $extension = $profile_pic->extension();
                if($extension=='jpg' || $extension=='png'){
                    $pic_path = $profile_pic->storeAs('public/profile_pic', time().'.'.$extension);
                }
                $StaffDetail->profile_pic = time().'.'.$extension;
            }
            $StaffDetail->save(); 
            for($i=0; $i < count($request->input('hobby')); $i++){
                // $hobby =  hobby::where('staff_detail_id', $StaffDetail->id)->first();
                    $hobby = new hobby;
                    $hobby->staff_detail_id = $StaffDetail->id;
                    $hobby->name = $request->input('hobby')[$i];
                    $hobby->save();
                // }else{
                //     $hobby->staff_detail_id = $StaffDetail->id;
                //     $hobby->name = $request->input('hobby')[$i];
                //     $hobby->save();
                // }
            }
            
            return redirect()->route('index')->with('message','updated successfully');

        }
                                    
    }
        

    public function destroy($id)
    {

        $hobby = Hobby::where('staff_detail_id', $id)->get();
        // dd($hobby);
        if(!empty($hobby)){
            foreach($hobby as $ho){
                $ho->delete();
            }
        }
        $StaffDetail = StaffDetail::find($id); 
        $StaffDetail->delete();
        return redirect()->route('index')->with('message',' deleted successfully');
    }

    public function checkeddelete(request $request)
    {
        $ids = $request->ids;
        // dd($ids);
        $hobby = Hobby::whereIn('staff_detail_id', $ids)->get();
        if(!empty($hobby)){
            foreach($hobby as $ho){
                $ho->delete();
            }  
        }
        $StaffDetail = StaffDetail::whereIn('id', $ids); 
        $StaffDetail->delete();
        return redirect()->route('index')->with('message',' deleted successfully');

    }
}

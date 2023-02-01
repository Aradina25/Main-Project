<?php

namespace App\Http\Controllers;

use App\Http\Middleware\AuthCheck;
use Illuminate\Http\Request;
use App\Models\tblregistration;
use App\Models\tbllogin;
use App\Models\tblbook;
use App\Models\tblstock;
use App\Models\tbllibrary;
use App\Models\tblprofilepicture;
use App\Models\tblfriend;
use App\Models\tblorder;
use App\Models\tblshippingaddress;
use App\Models\tblpost;
use App\Models\tblsuspention;
use DB;
use Session;

class AdBookController extends Controller
{

    public function adbook(){
        $data = array();
        if(Session::has('loginId')){
            $data =  tbllogin::where('loginid',"=",Session::get('loginId'))->first();
            $user = tblregistration::where('userid',$data->userid)->first();
            $bookdetails = tblbook::sortable()->paginate(6);
            $book = tblbook::all();
            $search= array();
            return view('AdminBook', compact('data','user','bookdetails','search','book'));
        }
        else{
            return view('login');
        }        
    }

    public function addbook(Request $req){
        $bookdet= new tblbook;
        $bookdet->title=preg_replace('/\s+/', ' ',$req->title);
        $bookdet->author=preg_replace('/\s+/', ' ',$req->author);
        $bookdet->genre=preg_replace('/\s+/', ' ',$req->genre);
        $bookdet->summary=preg_replace('/\s+/', ' ',$req->summary);
        $bookdet->pages=$req->pages;
        $bookdet->language=preg_replace('/\s+/', ' ',$req->language);
        $bookdet->publisher=preg_replace('/\s+/', ' ',$req->publisher);
        $bookdet->publish_date=$req->publish_date;
        $bookdet->ISBN=$req->ISBN;
        if($req->hasfile('cov_pic')){
            $file = $req->file('cov_pic');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'cp.'.$extension;
            $file->move('coverpics',$filename);
            $bookdet->cov_pic = $filename;
        }
        $bookdet->save();
        return redirect()->back()->with('status','DATA ADDED');
    }  

    public function addstock(Request $req){
        $stock= new tblstock;
        $accession_no= tblbook::where('title',$req->booktitle)->first('accession_no');
        $stock->accession_no = $accession_no->accession_no;
        $stock->type = $req->type;
        $stock->qty = $req->qty;
        $stock->price = $req->price;
        $stock->discount = $req->discount;
        $stock->save();
        return redirect()->back()->with('status','DATA ADDED');
    }
    public function searchbook(Request $req){
        // $search = $req->search;
        $search = tblbook::where('title','LIKE','%'.$req->search.'%')->orWhere('author','LIKE','%'.$req->search.'%')->orWhere('genre','LIKE','%'.$req->search.'%')->get();
        if(count($search)==0){
            return redirect()->back()->with('status','No results found');
        }
        else{
            $data =  tbllogin::where('loginid',"=",Session::get('loginId'))->first();
            $user = tblregistration::where('userid',$data->userid)->first();
            $bookdetails = tblbook::all();
            $book = tblbook::all();
                return view('AdminBook', compact('data','user','bookdetails','search','book')); 
        }
    }
    public function viewbook(Request $req,$accId){
        if(Session::has('loginId')){
            $data =  tbllogin::where('loginid',"=",Session::get('loginId'))->first();
            $user = tblregistration::where('userid',$data->userid)->first();
            $viewbook = tblbook::where('accession_no',$accId)->first();
            $stock = tblstock::where('accession_no',$viewbook->accession_no)->get();
            return view('ViewSpecBook', compact('viewbook','stock','user'));
        }
    }

    public function editbook(Request $req,$accId){
        $bookdet= new tblbook;
            tblbook::where('accession_no',$accId)->update(['title'=>$req->title,'author'=>$req->author,'genre'=>$req->genre,'summary'=>$req->summary,'pages'=>$req->pages,'language'=>$req->language,   'publisher'=>$req->publisher,'publish_date'=>$req->publish_date,'ISBN'=>$req->ISBN]);
            if($req->hasfile('cov_pic')){
                $file = $req->file('cov_pic');
                $extension = $file->getClientOriginalExtension();
                $filename = time().'cp.'.$extension;
                $file->move('coverpics',$filename);
                tblbook::where('accession_no',$accId)->update(['cov_pic' => $filename]);
            }
            $bookdet->update();
            return redirect()->back()->with($accId);
    }

    public function memberscon(){
        if(Session::has('loginId')){
            $data =  tbllogin::where('loginid',"=",Session::get('loginId'))->first();
            $user = tblregistration::where('userid',$data->userid)->first();
            $mem1 = tblregistration::where('status',"<>",1)->get();
            return view('adminMembers', compact('user','mem1'));
        }
    }

    public function memberspro($Id){
        if(Session::has('loginId')){
            $data =  tbllogin::where('loginid',"=",Session::get('loginId'))->first();
            $user = tblregistration::where('userid',$data->userid)->first();
            $memreg = tblregistration::where('userid',$Id)->first();
            $memlog = tbllogin::where('userid',$Id)->first();
            $memprop = tblprofilepicture::where('userid',$Id)->first();
            $memfrnd = tblfriend::where('userid',$Id)->get();
            $mempost = tblpost::where('userid',$Id)->where('status',1)->get();
            $memorders = tblorder::where('userid',$Id)->get();
            $memsus = tblsuspention::where('userid',$Id)->first();
            return view('adMemProfile', compact('memsus','memlog','user','memreg','memprop','memfrnd','mempost','memorders','Id'));
        }
    }

    public function block($id,$role){
        $reg = new tblregistration;
        $susp = new tblsuspention;
        if(Session::has('loginId')){
            $data =  tbllogin::where('loginid',"=",Session::get('loginId'))->first();
            $user = tblregistration::where('userid',$id)->first();
            $sus = tblsuspention::where('userid',$id)->first();
            if($user->status == 0 && $role==0){
                tblregistration::where('userid',$id)->update(['status'=>2]);
            } 
            elseif($user->status == 0 && $role==3){
                return redirect()->back()->with('error','Cannot suspend a user who is already blocked');
            }
            elseif($user->status == 2 && $role==0){
                tblregistration::where('userid',$id)->update(['status'=>0]);
            }
            elseif($user->status == 2 && $role==3){
                if($sus->suspend == 2){
                    tblsuspention::where('userid',$id)->update(['suspend'=>3,'created_at'=>date('Y-m-d h:m:s'),'end_date'=>NULL]);
                    tblregistration::where('userid',$id)->update(['status'=>0]);
                }
                else if($sus->suspend == 0){
                    $date = strtotime("+8 day");
                    $enddate = date('Y-m-d h:m:s',$date);
                    tblsuspention::where('userid',$id)->update(['suspend'=>1,'created_at'=>date('Y-m-d h:m:s'),'end_date'=>$enddate]);
                    tblregistration::where('userid',$id)->update(['status'=>3]);
                }
                else if($sus->suspend == 1){
                    $date = strtotime("+15 day");
                    $enddate = date('Y-m-d h:m:s',$date);
                    tblsuspention::where('userid',$id)->update(['suspend'=>2,'created_at'=>date('Y-m-d h:m:s'),'end_date'=>$enddate]);
                    tblregistration::where('userid',$id)->update(['status'=>3]);
                }
            }
            elseif($user->status == 3 && $role==0){
                tblregistration::where('userid',$id)->update(['status'=>0]);
            }   
            else{
                tblregistration::where('userid',$id)->update(['status'=>2]);
            }
            $susp->update();
            $reg->update();
            return redirect()->back();
        }
    }

    public function memorders(){
        if(Session::has('loginId')){
            $data =  tbllogin::where('loginid',"=",Session::get('loginId'))->first();
            $user = tblregistration::where('userid',$data->userid)->first();
            $order = tblorder::all();
            return view('adminOrders', compact('user','order'));
        }
    }

    public function orderdet($Id){
        if(Session::has('loginId')){
            $data =  tbllogin::where('loginid',"=",Session::get('loginId'))->first();
            $user = tblregistration::where('userid',$data->userid)->first();
            $odet = tblorder::where('orderid',$Id)->first();
            return view('adMemOrder', compact('odet'));
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\tblregistration;
use App\Models\tbllogin;
use App\Models\tblbook;
use App\Models\tbllibrary;
use App\Models\tblchallenge;
use App\Models\tblprofilepicture;
use App\Models\tblcart;
use App\Models\tblshippingaddress;
use App\Models\tblfriend;
use App\Models\tblorder;
use App\Models\tblstock;
use App\Models\tblpost;
use App\Models\tblpersonalstore;
use App\Models\tblthriftorder;
use App\Models\tblreview;
use App\Models\tblthriftnegotiate;
use Stripe;
use DB;
use Session;
use App;
use Carbon\Carbon;
use PDF;

class MemBookController extends Controller
{
    public function ownprofileview(){
        $data =  tbllogin::where('loginid',"=",Session::get('loginId'))->first();
        $user = tblregistration::where('userid',$data->userid)->first();
        $profile = tblprofilepicture::where('userid',$user->userid)->first();
        $posts = tblpost::where('userid',$user->userid)->orderBy('created_at', 'desc')->get();
        $challenge = tblchallenge::where('userid',$user->userid)->where('status',1)->first();
        if($challenge->goal==0){
            $width=0;
        }
        else{
            $width = ($challenge->completedgoal*100)/$challenge->goal;
        }
        $challengecheck = tblchallenge::where('userid',$user->userid)->where('status',1)->first();
        $librarycheck =  tbllibrary::where('userid',$user->userid)->where('status',3)->where('updated_at','>=',$challenge->Createdat)->get();
        $tobesold = tblpersonalstore::where('userid',$user->userid)->where('status',1)->get();
        $soldbooks = tblpersonalstore::where('userid',$user->userid)->where('status',0)->get();
        // tblchallenge::where('userid',$user->userid)->where('status',1)->update(['completedgoal'=>count($librarycheck)]);
        $tbr = tbllibrary::where('userid',$user->userid)->where('status',1)->get();
        $curr = tbllibrary::where('userid',$user->userid)->where('status',2)->get();
        $done = tbllibrary::where('userid',$user->userid)->where('status',3)->get(); 
        return view('ownprofie', compact('user','data','profile','challenge','tbr','curr','done','librarycheck','width','posts','tobesold','soldbooks'));
    }
    public function profileview(){
        $data =  tbllogin::where('loginid',"=",Session::get('loginId'))->first();
        $user = tblregistration::where('userid',$data->userid)->first();
        $profile = tblprofilepicture::where('userid',$user->userid)->first();
        $challenge = tblchallenge::where('userid',$user->userid)->where('status',1)->first();
        if($challenge->goal==0){
            $width=0;
        }
        else{
            $width = ($challenge->completedgoal*100)/$challenge->goal;
        }
        $challengecheck = tblchallenge::where('userid',$user->userid)->where('status',1)->first();
        $librarycheck =  tbllibrary::where('userid',$user->userid)->where('status',3)->where('updated_at','>=',$challenge->Createdat)->get();
        $tobesold = tblpersonalstore::where('userid',$user->userid)->where('status',1)->get();
        $soldbooks = tblpersonalstore::where('userid',$user->userid)->where('status',0)->get();
        // tblchallenge::where('userid',$user->userid)->where('status',1)->update(['completedgoal'=>count($librarycheck)]);
        $tbr = tbllibrary::where('userid',$user->userid)->where('status',1)->get();
        $curr = tbllibrary::where('userid',$user->userid)->where('status',2)->get();
        $done = tbllibrary::where('userid',$user->userid)->where('status',3)->get();
        return view('memberprofile', compact('user','data','profile','challenge','tbr','curr','done','librarycheck','width','tobesold','soldbooks'));
    }

    public function memsearch(Request $req){
        $s=$req->search;
        $data =  tbllogin::where('loginid',"=",Session::get('loginId'))->first();
        $user = tblregistration::where('userid',$data->userid)->first();
        $search = tblbook::where('title','LIKE','%'.$req->search.'%')->orWhere('author','LIKE','%'.$req->search.'%')->orWhere('genre','LIKE','%'.$req->search.'%')->orderBy('rating','DESC')->get();
        $challenge = tblchallenge::where('userid',$user->userid)->where('status',1)->first();
        $challengecheck = tblchallenge::where('userid',$user->userid)->where('status',1)->first();
        $librarycheck =  tbllibrary::where('userid',$user->userid)->where('status',3)->where('updated_at','>=',$challenge->Createdat)->get();
        // tblchallenge::where('userid',$user->userid)->where('status',1)->update(['completedgoal'=>count($librarycheck)]);
        $tobesold = tblpersonalstore::where('userid',$user->userid)->where('status',1)->get();
        $soldbooks = tblpersonalstore::where('userid',$user->userid)->where('status',0)->get();
        $completedbooks = tblbook::all('accession_no','title');
            if($challenge->goal==0){
                $width=0;
            }
            else{
                $width = ($challenge->completedgoal*100)/$challenge->goal;
            }
            $tbr = tbllibrary::where('userid',$user->userid)->where('status',1)->get();
            $curr = tbllibrary::where('userid',$user->userid)->where('status',2)->get();
            $done = tbllibrary::where('userid',$user->userid)->where('status',3)->get(); 
            $searchp=array(); 
            $follow=array(); 
        if(count($search)==0){
            $searchp = tblregistration::where('fullname','LIKE','%'.$req->search.'%')->where('status',2)->get();
            $follow = tblfriend::where('userid',$user->userid)->where('approved',1)->get();
        }
            $bookdetails = tblbook::all();
                return view('userviewbook', compact('data','user','s','bookdetails','search','searchp','width','challenge','tbr','curr','done','librarycheck','follow','tobesold','soldbooks'));
    }

    public function memviewbook(Request $req,$accId){
        if(Session::has('loginId')){
            $data =  tbllogin::where('loginid',"=",Session::get('loginId'))->first();
            $user = tblregistration::where('userid',$data->userid)->first();
            $viewbook = tblbook::where('accession_no',$accId)->first();
            $thrift = tblpersonalstore::where('bookid',$accId)->get();
            $pricehc = tblstock::where('accession_no',$accId)->where('type','Hardcover')->first();
            $pricepb = tblstock::where('accession_no',$accId)->where('type','Paperback')->first();
            $priceeb = tblstock::where('accession_no',$accId)->where('type','EBook')->first();
            // echo empty($pricehc);
            $challenge = tblchallenge::where('userid',$user->userid)->where('status',1)->first();
            if($challenge->goal==0){
                $width=0;
            }
            else{
                $width = ($challenge->completedgoal*100)/$challenge->goal;
            }
            $challengecheck = tblchallenge::where('userid',$user->userid)->where('status',1)->first();
            $librarycheck =  tbllibrary::where('userid',$user->userid)->where('status',3)->where('updated_at','>=',$challenge->Createdat)->get();
            // tblchallenge::where('userid',$user->userid)->where('status',1)->update(['completedgoal'=>count($librarycheck)]);
            $tobesold = tblpersonalstore::where('userid',$user->userid)->where('status',1)->get();
            $soldbooks = tblpersonalstore::where('userid',$user->userid)->where('status',0)->get();
            $tbr = tbllibrary::where('userid',$user->userid)->where('status',1)->get();
            $curr = tbllibrary::where('userid',$user->userid)->where('status',2)->get();
            $done = tbllibrary::where('userid',$user->userid)->where('status',3)->get(); 
            $reviewtab = tblreview::where('bookid',$accId)->get();
            // echo $price;
        }
        return view('MemViewSpecBook', compact('viewbook','user','width','challenge','tbr','curr','done','librarycheck','pricehc','pricepb','priceeb','thrift','tobesold','soldbooks','reviewtab'));
    }


    public function markbook(Request $req,$accId,$stat){
        $lib = new tbllibrary;
        $chal = new tblchallenge;
        if(Session::has('loginId')){
            $data =  tbllogin::where('loginid',"=",Session::get('loginId'))->first();
            $user = tblregistration::where('userid',$data->userid)->first();
            $liby = tbllibrary::where('userid',$user->userid)->where('status',$stat)->get();
            if(!$liby->contains('accession_no',$accId)){
                tbllibrary::where('userid',$user->userid)->where('accession_no',$accId)->delete();
                $lib->userid=$data->userid;
                $lib->accession_no=$accId;
                $lib->status=$stat;
                $lib->save();
            }
            $challengecheck = tblchallenge::where('userid',$user->userid)->where('status',1)->first();
            $librarycheck =  tbllibrary::where('userid',$user->userid)->where('status',3)->where('updated_at','>=',$challengecheck->Createdat)->get();
            tblchallenge::where('userid',$user->userid)->where('status',1)->update(['completedgoal'=>count($librarycheck)]);
            $chal->update();
            $this->challenge_success();
            
            $tbr = tbllibrary::where('userid',$user->userid)->where('status',1)->get();
            $curr = tbllibrary::where('userid',$user->userid)->where('status',2)->get();
            $done = tbllibrary::where('userid',$user->userid)->where('status',3)->get(); 
            return redirect()->back()->with('tbr','curr','done','librarycheck');
            // return view('MemViewSpecBook', compact('viewbook','user'));
        }
    }

    // challenge

    public function challenge(Request $req){
        $challenge = new tblchallenge;
        if(Session::has('loginId')){
            $data =  tbllogin::where('loginid',"=",Session::get('loginId'))->first();
            $user = tblregistration::where('userid',$data->userid)->first();     
            $profile = tblprofilepicture::where('userid',$user->userid)->first();
            if($req->goalsetter< $profile->min){
                return redirect()->back()->with('ming','Minimum goal should be '.$profile->min);
            }    
            tblchallenge::where('userid',$user->userid)->update(['goal'=>$req->goalsetter,'Createdat'=>Carbon::now()->toDateTimeString()]);
            $challenge->update();
            return redirect()->back();
        }
    }

    public function challenge_success(){
        $chal = new tblchallenge;
        $pp = new tblprofilepicture;
        $post = new tblpost;
        if(Session::has('loginId')){
            $data =  tbllogin::where('loginid',"=",Session::get('loginId'))->first();
            $user = tblregistration::where('userid',$data->userid)->first(); 
            $challenge = tblchallenge::where('userid',$user->userid)->where('status',1)->first();
            $profile = tblprofilepicture::where('userid',$user->userid)->first();
            if($challenge->goal == $challenge->completedgoal){
                tblprofilepicture::where('userid',$user->userid)->update(['level'=>$profile->level+1,'min'=>$profile->min+2]);
                $pp->update();
                tblchallenge::where('userid',$user->userid)->where('status',1)->update(['status'=>0]);
                $chal->update();
                $id=$user->userid;
                $chal->userid = $id;
                $chal->save();
                $post->userid = $id;
                $post->image = "celeb.jpg";
                $post->body= "Congratulations. You have completed the challenge. You have been upgraded to level ".($profile->level+1).".";
                $post->status = 0;
                $post->save();
                
            }
        }        

    }



    // cart 

    public function buybook(Request $req,$accId,$stat){
        $buy = new tblcart;
        if(Session::has('loginId')){
            $data =  tbllogin::where('loginid',"=",Session::get('loginId'))->first();
            $user = tblregistration::where('userid',$data->userid)->first();
            if($stat==1){
                $stock = tblstock::where('accession_no',$accId)->where('type',"Hardcover")->first();
                $amt = ($stock->price)-(($stock->discount*$stock->price)/100);  
            }
            elseif($stat==2){
                $stock = tblstock::where('accession_no',$accId)->where('type',"Paperback")->first();
                $amt = ($stock->price)-(($stock->discount*$stock->price)/100);
                
            }
            else{
                $stock = tblstock::where('accession_no',$accId)->where('type',"EBook")->first();
                $amt = ($stock->price)-(($stock->discount*$stock->price)/100);
            }
            $buy->userid=$user->userid;
            $buy->stockid = $stock->stockid;
            $buy->save();
            return redirect()->back();
        }
    }

    public function viewcart(){
        if(Session::has('loginId')){
            $data =  tbllogin::where('loginid',"=",Session::get('loginId'))->first();
            $user = tblregistration::where('userid',$data->userid)->first();
            $cart = tblcart::where('userid',$user->userid)->get(); 
            return view('cart',compact('user','cart'));
        }
    }

    public function deletebook(Request $req,$cartId){
        if(Session::has('loginId')){
            $data =  tbllogin::where('loginid',"=",Session::get('loginId'))->first();
            $user = tblregistration::where('userid',$data->userid)->first();
            tblcart::where('userid',$user->userid)->where('cartid',$cartId)->delete();
            // $cartcount = count($cart);
            // for( $i=0; $i < $cartcount; $i++){
            //     $c[$i] = $cart[$i]->accession_no;
            //     $book[$i] = tblbook::where('accession_no',$c[$i])->first();
            // } 
            // echo $book[$i];
            return redirect()->back();
        }
    }

    public function updatecart(Request $req,$cartid){
        $qty = new tblcart;
        if(Session::has('loginId')){
            $data =  tbllogin::where('loginid',"=",Session::get('loginId'))->first();
            $user = tblregistration::where('userid',$data->userid)->first();
            $cart = tblcart::where('cartid',$cartid)->first();
            $stock = tblstock::where('stockid',$cart->stockid)->first();
            if($req->qty > $stock->qty )
                $req->qty = $stock->qty;
            tblcart::where('cartid',$cartid)->update(['userid'=>$user->userid,'stockid'=>$cart->stockid,'qty'=>$req->qty]);
            $qty->update();        
            return redirect()->back();
        }
    }

    public function shippingaddress(Request $req){
        $data =  tbllogin::where('loginid',"=",Session::get('loginId'))->first();
        $user = tblregistration::where('userid',$data->userid)->first();
        $ship= new tblshippingaddress;
        $shipadd = tblshippingaddress::where('userid',$data->userid)->update(['status'=>0]);
        $ship = tblshippingaddress::where('userid',$user->userid)->first();
        $cart = tblcart::where('userid',$user->userid)->get();
        $order = new tblorder;
        $orderupdate = tblorder::where('userid',$data->userid)->update(['status'=>0]);
        $order->shippingid = DB::table('tblshippingaddresses')->insertGetId(['userid'=>$user->userid,'firstname'=>preg_replace('/\s+/', ' ',$req->fname),'lastname'=>preg_replace('/\s+/', ' ',$req->lname),'address'=>preg_replace('/\s+/', ' ',$req->address),'country'=>preg_replace('/\s+/', ' ',$req->country),'zipcode'=>preg_replace('/\s+/', ' ',$req->zipcode),'city'=>preg_replace('/\s+/', ' ',$req->city),'state'=>preg_replace('/\s+/', ' ',$req->state)]);
        $order->userid=$user->userid;
        $totalamt=0;
        foreach($cart as $c)
        {
            $stock = tblstock::where('stockid',$c->stockid)->first();
            $totalamt= $totalamt+($c->qty*$stock->price);
        }
        $order->totalamt = $totalamt;
        if($totalamt>750){
            $order->paymentamt = $totalamt;
        }
        else{
            $order->paymentamt = $totalamt+50;
        }
        $order->save();
        $orders = tblorder::where('userid',$user->userid)->where('status',1)->first();
        return redirect('/paymentprocess');
        // return view('orderconfirmation',compact('user','ship','cart','orders'));
    }

    public function generatePDF(){
        $data =  tbllogin::where('loginid',"=",Session::get('loginId'))->first();
        $user = tblregistration::where('userid',$data->userid)->first();
        $ship = tblshippingaddress::where('userid',$user->userid)->first();
        $cart = tblcart::where('userid',$user->userid)->get();
        $orders = tblorder::where('userid',$user->userid)->where('status',1)->first();
        // echo $cart; 
        $pdf = PDF::setOptions(['isHTML5ParserEnabled'=> true , 'isRemoteEnabled'=>true, 'defaultFont'=>'sans-serif']);
        $pdf = PDF::loadView('orderconfirm',compact('user','ship','cart','orders'));
        $pdf->setPaper('a4', 'portrait');
        return $pdf->download('invoice.pdf');
    }

    public function paymentprocess(Request $request){
        echo "hello";
       Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
       Stripe\Charge::create([
        "amount"=>100,
        "currency"=>"USD",
        "source"=>$request->stripeToken,
        "description"=>"This is payment testing"]);
        return view('orderconfirmation',compact('user','ship','cart','orders'));
    }
    

    // personal store
    public function addtostore(Request $req){
        $add = new tblpersonalstore;
        if(Session::has('loginId')){
            $data =  tbllogin::where('loginid',"=",Session::get('loginId'))->first();
            $user = tblregistration::where('userid',$data->userid)->first();
            $add->userid = $user->userid;
            $add->btitle=preg_replace('/\s+/', ' ',$req->btitle);
            $add->bauthor=preg_replace('/\s+/', ' ',$req->bauthor);
            // $add->frontcov;
            if($req->hasfile('bcov_pic')){
                $file = $req->file('bcov_pic');
                $extension = $file->getClientOriginalExtension();
                $filename = time().'usercp.'.$extension;
                $file->move('coverpics',$filename);
                $add->frontcov = $filename;
            }

            if($req->hasfile('back_pic')){
                $file = $req->file('back_pic');
                $extension = $file->getClientOriginalExtension();
                $filename = time().'userbc.'.$extension;
                $file->move('coverpics',$filename);
                $add->backcov = $filename;
            }

            if($req->hasfile('page1')){
                $file = $req->file('page1');
                $extension = $file->getClientOriginalExtension();
                $filename = time().'userpage.'.$extension;
                $file->move('coverpics',$filename);
                $add->page1 = $filename;
            }

            if($req->hasfile('page2')){
                $file = $req->file('page2');
                $extension = $file->getClientOriginalExtension();
                $filename = time().'userpage.'.$extension;
                $file->move('coverpics',$filename);
                $add->page2 = $filename;
            }
            if($req->hasfile('page3')){
                $file = $req->file('page3');
                $extension = $file->getClientOriginalExtension();
                $filename = time().'userpage.'.$extension;
                $file->move('coverpics',$filename);
                $add->page3 = $filename;
            }
            $add->bcondition = preg_replace('/\s+/', ' ',$req->condition);
            $add->blanguage = preg_replace('/\s+/', ' ',$req->blanguage);
            $add->bisbn = preg_replace('/\s+/', ' ',$req->bISBN);
            $add->format = preg_replace('/\s+/', ' ',$req->bformat);
            $add->summary = preg_replace('/\s+/', ' ',$req->summary);
            $add->rating = preg_replace('/\s+/', ' ',$req->rating);
            $add->maxprice = preg_replace('/\s+/', ' ',$req->price);
            $add->minprice = preg_replace('/\s+/', ' ',$req->minprice);
            $add->save();
            return redirect()->back();
        }
    }

    //thrift
    public function thrift($accId,$userid){
        if(Session::has('loginId')){
            $data =  tbllogin::where('loginid',"=",Session::get('loginId'))->first();
            $user = tblregistration::where('userid',$data->userid)->first();
            $thrift = tblpersonalstore::where('userid',$userid)->where('bookid',$accId)->first();
            $challenge = tblchallenge::where('userid',$user->userid)->where('status',1)->first();
            if($challenge->goal==0){
                $width=0;
            }
            else{
                $width = ($challenge->completedgoal*100)/$challenge->goal;
            }
            $challengecheck = tblchallenge::where('userid',$user->userid)->where('status',1)->first();
            $librarycheck =  tbllibrary::where('userid',$user->userid)->where('status',3)->where('updated_at','>=',$challenge->Createdat)->get();
            $tobesold = tblpersonalstore::where('userid',$user->userid)->where('status',1)->get();
            $soldbooks = tblpersonalstore::where('userid',$user->userid)->where('status',0)->get();
            $tbr = tbllibrary::where('userid',$user->userid)->where('status',1)->get();
            $curr = tbllibrary::where('userid',$user->userid)->where('status',2)->get();
            $done = tbllibrary::where('userid',$user->userid)->where('status',3)->get(); 

        }
        return view('thriftpage', compact('user','thrift','challenge','tbr','curr','done','librarycheck','width','tobesold','soldbooks'));
    }

    public function buythrift(Request $req,$sellerid,$storeid){
        $addthrift = new tblthriftorder;
        if(Session::has('loginId')){
            $data =  tbllogin::where('loginid',"=",Session::get('loginId'))->first();
            $user = tblregistration::where('userid',$data->userid)->first();
            $addthrift->userid = $sellerid;
            $addthrift->customerid = $user->userid;
            $addthrift->personalstoreid = $storeid;
            $addthrift->negotiate = $req->yesnego;
            $addthrift->amount = $req->nego;
            $addthrift->save();
        }
        return view('address');
    }

    public function negothrift(Request $req,$sellerid,$storeid){
        $negthrift = new tblthriftnegotiate;
        if(Session::has('loginId')){
            $data =  tbllogin::where('loginid',"=",Session::get('loginId'))->first();
            $user = tblregistration::where('userid',$data->userid)->first();
            $negthrift->sellerid = $sellerid;
            $negthrift->customerid = $user->userid;
            $negthrift->personalstoreid = $storeid;
            $negthrift->negoamt = $req->nego;
            $negthrift->save();
        }
        return redirect()->back();
    }

    public function currsale(){
        $data =  tbllogin::where('loginid',"=",Session::get('loginId'))->first();
        $user = tblregistration::where('userid',$data->userid)->first();
            $challenge = tblchallenge::where('userid',$user->userid)->where('status',1)->first();
            if($challenge->goal==0){
                $width=0;
            }
            else{
                $width = ($challenge->completedgoal*100)/$challenge->goal;
            }
            $challengecheck = tblchallenge::where('userid',$user->userid)->where('status',1)->first();
            $librarycheck =  tbllibrary::where('userid',$user->userid)->where('status',3)->where('updated_at','>=',$challenge->Createdat)->get();
            // tblchallenge::where('userid',$user->userid)->where('status',1)->update(['completedgoal'=>count($librarycheck)]);
            $tobesold = tblpersonalstore::where('userid',$user->userid)->where('status',1)->get();
            $soldbooks = tblpersonalstore::where('userid',$user->userid)->where('status',0)->get();
            $tbr = tbllibrary::where('userid',$user->userid)->where('status',1)->get();
            $curr = tbllibrary::where('userid',$user->userid)->where('status',2)->get();
            $done = tbllibrary::where('userid',$user->userid)->where('status',3)->get(); 
        $currentsales = tblthriftnegotiate::where('sellerid',$user->userid)->where('status',1)->get();
        return view('thriftsales', compact('user','width','challenge','tbr','curr','done','librarycheck','tobesold','soldbooks','currentsales'));
    }

    public function sellernego($Id,$action){
        $negthrift = new tblthriftnegotiate;
        if(Session::has('loginId')){
            $data =  tbllogin::where('loginid',"=",Session::get('loginId'))->first();
            $user = tblregistration::where('userid',$data->userid)->first();
            tblthriftnegotiate::where('id',$Id)->where('status',1)->update(['action'=>$action]);
            $negthrift->update();
        }
        return redirect()->back();
    }

    public function review(Request $req,$bookid){
        $addreview = new tblreview;
        $book = new tblbook;
        if(Session::has('loginId')){
            $data =  tbllogin::where('loginid',"=",Session::get('loginId'))->first();
            $user = tblregistration::where('userid',$data->userid)->first();
            $addreview->bookid = $bookid;
            $addreview->userid = $user->userid;
            $addreview->review = $req->review;
            $addreview->rating = $req->rating;
            $addreview->save();
            tblbook::where('accession_no',$bookid)->update(['rating'=>tblreview::avg('rating')]);
            $book->update();
            return redirect()->back();
        }
    }
}

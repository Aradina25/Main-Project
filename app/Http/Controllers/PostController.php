<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tblpost;
use App\Models\tblregistration;
use App\Models\tbllogin;
use thiagoalessio\TesseractOCR\TesseractOCR;
use App\Models\tblbook;
use App\Models\tblreview;
use App\Models\tblstock;
use Illuminate\Support\Facades\Storage;
use File;
use Session;

class PostController extends Controller
{
    public function postUpload(Request $req){
        if(Session::has('loginId')){
            $data =  tbllogin::where('loginid',"=",Session::get('loginId'))->first();
            $user = tblregistration::where('userid',$data->userid)->first();
            $post = new tblpost;
            $post->userid = $user->userid;
            // echo $req->hasfile('postimage');
            if($req->hasfile('postimage')){
                $file = $req->file('postimage');
                $extension = $file->getClientOriginalExtension();
                $filename = $user->userid.time().".".$extension;
                $file->move('posts',$filename);
                $post->image = $filename;
            }
            $post->body=$req->wom;
            $post->save();
            return redirect()->back()->with('status','post uploaded');
        }
    }

    public function editposts(Request $req){
        if(Session::has('loginId')){
            $data =  tbllogin::where('loginid',"=",Session::get('loginId'))->first();
            $user = tblregistration::where('userid',$data->userid)->first();
            $upt = new tblpost;
            $post = tblpost::where('postid',$req->id)->first();
            if($req->hasfile('editimage')){
                $file = $req->file('editimage');
                $extension = $file->getClientOriginalExtension();
                $filename = $user->userid.time().".".$extension;
                $file->move('posts',$filename);
            }
            else{
                $filename = $post->image;
            }
            if($req->editwom == "")
                $body = $post->body;
            else
                $body = $req->editwom;

            tblpost::where('postid',$req->id)->update(['userid'=>$user->userid,'image'=>$filename,'body'=>$body]);
            $upt->update();
            return redirect()->back();
        }
    }

    public function deletepost(Request $req,$postid){
        if(Session::has('loginId')){
            $data =  tbllogin::where('loginid',"=",Session::get('loginId'))->first();
            $user = tblregistration::where('userid',$data->userid)->first();
            tblpost::where('userid',$user->userid)->where('postid',$postid)->delete();
            return redirect()->back();
        }
    }

    // public function viewfrndpost(){
    //     if(Session::has('loginId')){
    //         $data =  tbllogin::where('loginid',"=",Session::get('loginId'))->first();
    //         $user = tblregistration::where('userid',$data->userid)->first();
    //         return view('', compact('user','data','profile
    //     }
    // }

    public function scanner(Request $req){
        if($req->hasfile('postimage')){
            $file = $req->file('postimage');
            $extension = $file->getClientOriginalExtension();
            $filename = "Random".time().".".$extension;
            $file->move('posts',$filename);
        }
                    
            $path = "posts/".$filename;
            // $path = "images/kite.jpg";
            // $text = (new TesseractOCR($path))->executable('C:\Program Files (x86)\Tesseract-OCR\tesseract.exe')->lang('eng')->run();
            // echo $text;
            $text = shell_exec("python seminar/scan.py $path");
            $text = substr($text, 0, -1);
            // echo $text;
            $viewbook = tblbook::where('title','like', '%'.$text.'%')->first();
            if($viewbook==""){
                return back()->with('noscan','The book is not available');
            }
            // echo $viewbook;
            File::delete($path);
            $reviewtab = tblreview::where('bookid',$viewbook->accession_no)->get();
            $pricehc = tblstock::where('accession_no',$viewbook->accession_no)->where('type','Hardcover')->first();
            $pricepb = tblstock::where('accession_no',$viewbook->accession_no)->where('type','Paperback')->first();
            $priceeb = tblstock::where('accession_no',$viewbook->accession_no)->where('type','EBook')->first();
            

            return view('scanbook', compact('viewbook','reviewtab','pricehc','pricepb','priceeb'));
        
        }
}

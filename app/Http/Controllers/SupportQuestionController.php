<?php

namespace App\Http\Controllers;

use App\SupportAns;
use App\SupportDept;
use App\SupportQuestion;
use Illuminate\Http\Request;
use Auth;

class SupportQuestionController extends Controller
{
    public function index(){
        $departments = SupportDept::all();
        return view('admin.open-support-ticket')->with([
            'departments'   => $departments
        ]);
    }

    public function getSupportQuestion(){
        $auth_id = Auth::user()->id;
        $support_depts = SupportDept::whereHas('users',function($q) use($auth_id){
            $q->where('user_id',$auth_id);
        })->pluck('id');
        $support_tickets = SupportQuestion::WhereIn('support_dept_id',$support_depts)
            ->orWhere('user_id',$auth_id)->orderBy('id','desc')->get();
        return view('admin.support-tickets')->with([
            'support_tickets'  => $support_tickets
        ]);
    }

    public function getSupportTecket($id){
        $support_ticket = SupportQuestion::findOrFail($id);
        if($support_ticket->user_id != Auth::user()->id){
            $dept = SupportDept::find($support_ticket->support_dept_id);
            if(!$dept->users->contains(Auth::user()->id)){
                return redirect()->back();
            }
        }
        return view('admin.single-support-ticket')->with([
            'support_ticket'   => $support_ticket
        ]);
    }

    public function create(Request $request){

        $support_ticket = SupportQuestion::create([
            'complain'          => $request->input('question'),
            'title'             => $request->input('title'),
            'support_dept_id'   => $request->input('department'),
            'user_id'           => Auth::user()->id,
        ]);

        if($request->file('document')){
            $photoName = time().'.'.$request->document->getClientOriginalExtension();
            $request->document->move(public_path('documents'), $photoName);
            $support_ticket->document = $photoName;
            $support_ticket->save();
        }

        return redirect()->route('support-question');
    }

    public function postAnswer(Request $request, $id){
        $support_ticket = SupportQuestion::find($id);
        if($support_ticket->department->users->contains(Auth::user()->id)){
            SupportAns::create([
                'ans'           => $request->input('ans'),
                'question_id'   => $support_ticket->id,
                'user_id'       => Auth::user()->id
            ]);
        }

        return redirect()->back();

    }

    public function changeStatus($id, $status){
        $support_ticket = SupportQuestion::find($id);

        if($support_ticket->department->users){
            if($support_ticket->department->users->contains(Auth::user()->id) || $support_ticket->user_id == Auth::user()->id){
                $support_ticket->update([
                    'status'    => $status
                ]);
            }
        }

        return redirect()->back();
    }

}

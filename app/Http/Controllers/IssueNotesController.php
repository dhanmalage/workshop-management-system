<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\IssueNote;
use DB;
use App\Job;
use App\Http\Requests\IssueNoteRequest;
use App\IssueNoteDetail;
use Illuminate\Support\Facades\Auth;
use App\Item;

class IssueNotesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $issue_notes = IssueNote::all();
        return view('issue_notes.issue_notes', compact('issue_notes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jobs = DB::table('jobs')->where('status', '=', 'open')->get();
        //$jobs = Job::lists('id', 'id')->all();
        return view('issue_notes.create', compact('jobs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(IssueNoteRequest $request)
    {
        $user = Auth::user();

        $input = $request->all();

        $issue_note = new IssueNote();
        $issue_note->remark = $input['remark'];
        $issue_note->created_by = $user->id;

        $issue_note->save($request->all());
        for($i=0;$i<count($input['job_id']);$i++)
        {
            if($input['quantity_issue'][$i] != null && $input['quantity_issue'][$i] != '0') {

                $item_data = DB::table('job_details')->where('id', $input['detail_id'][$i])->first();

                $issue_note_detail = new IssueNoteDetail();

                $issue_note_detail->job_id = $input['job_id'][$i];
                $issue_note_detail->item_id = $item_data->item_id;
                $issue_note_detail->item_description = $item_data->item_description;
                $issue_note_detail->quantity_requested = $input['quantity_req'][$i];
                $issue_note_detail->quantity_issued = $input['quantity_issue'][$i];


                if($input['quantity_req'][$i] == $input['quantity_issue'][$i]){

                    DB::table('job_details')->where('id', $input['detail_id'][$i])->update(['task_status' => 'complete']);

                }

                DB::table('job_details')
                    ->where('id', $input['detail_id'][$i])
                    ->increment('quantity_issued', $input['quantity_issue'][$i]);

                DB::table('job_details')
                    ->where('id', $input['detail_id'][$i])
                    ->decrement('balance_quantity', $input['quantity_issue'][$i]);

                DB::table('items')
                    ->where('id', $item_data->item_id)
                    ->decrement('quantity', $input['quantity_issue'][$i]);

                $issue_note->issue_note_details()->save($issue_note_detail);
            }
        }
        return redirect('/issue_notes');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $issue_note = IssueNote::findOrFail($id);
        $issue_note_details = DB::table('issue_note_details')->where('issue_note_id', '=', $id)->get();
        $items = Item::all();

        return view('issue_notes.single_issue_note', compact('issue_note', 'issue_note_details', 'items'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

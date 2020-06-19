<?php

namespace App\Http\Controllers;

use App\ReportQuery;
use Illuminate\Http\Request;

class ReportQueryController extends Controller
{
    public function index()
    {
        //
        $queries = ReportQuery::whereType('message')->paginate(10);
        return view('admin.reported.view_reported_messages', compact('queries'));
    }
    public function reported_videos()
    {
        $queries = ReportQuery::whereType('video')->paginate(10);
        return view('admin.reported.view_reported_videos', compact('queries'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
        ReportQuery::create($request->except('_token'));
        return back()->withSuccess('Reported');
    }

    public function show(ReportQuery $reportQuery)
    {
        //
    }

    public function edit(ReportQuery $reportQuery)
    {
        //
    }

    public function update(Request $request, $reportQuery)
    {
        //
        ReportQuery::whereId($reportQuery)->whereType($request->input('type'))->update(['is_resolved'=>1]);
        return back()->withSuccess('Marked as Resolved');
    }

    public function destroy($report_query)
    {
        //
        ReportQuery::whereId($report_query)->delete();
        return back()->withSuccess('Query Deleted');
    }
}

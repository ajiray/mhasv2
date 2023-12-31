<?php

namespace App\Http\Controllers;

use App\Models\Summary;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;

class SummaryController extends Controller
{
    public function filterSummaries(Request $request)
{
    // Get the selected values from the request
    $counselorId = $request->input('counselorFilter');
    $program = $request->input('programFilter');
    $reason = $request->input('reasonFilter');
    $type = $request->input('typeFilter');
    $fromDate = $request->input('fromDateFilter');
    $toDate = $request->input('toDateFilter');

    // Fetch filtered summaries based on the selected filters
    $filteredSummaries = Summary::with('student', 'counselor')
        ->when($counselorId, function ($query, $counselorId) {
            return $query->where('counselor_id', $counselorId);
        })
        ->when($program, function ($query, $program) {
            return $query->where('course', $program);
        })
        ->when($reason, function ($query, $reason) {
            return $query->where('reason', $reason);
        })
        ->when($type, function ($query, $type) {
            return $query->where('type', $type);
        })
        ->when($fromDate, function ($query, $fromDate) {
            return $query->whereDate('date', '>=', $fromDate);
        })
        ->when($toDate, function ($query, $toDate) {
            return $query->whereDate('date', '<=', $toDate);
        })
        ->get();
        $totalCount = $filteredSummaries->count();

    // Return the filtered summaries as JSON
    return response()->json(['summaries' => $filteredSummaries, 'totalAppointments' => $totalCount]);
}


public function generatepdf(Request $request)
{
    // Get the selected values from the request
    $counselorId = $request->input('counselorFilter');
    $program = $request->input('programFilter');
    $reason = $request->input('reasonFilter');
    $type = $request->input('typeFilter');
    $fromDate = $request->input('fromDateFilter');
    $toDate = $request->input('toDateFilter');

    // Fetch filtered summaries based on the selected filters
    $filteredSummaries = Summary::with('student', 'counselor')
        ->when($counselorId, function ($query, $counselorId) {
            return $query->where('counselor_id', $counselorId);
        })
        ->when($program, function ($query, $program) {
            return $query->where('course', $program);
        })
        ->when($reason, function ($query, $reason) {
            return $query->where('reason', $reason);
        })
        ->when($type, function ($query, $type) {
            return $query->where('type', $type);
        })
        ->when($fromDate, function ($query, $fromDate) {
            return $query->whereDate('date', '>=', $fromDate);
        })
        ->when($toDate, function ($query, $toDate) {
            return $query->whereDate('date', '<=', $toDate);
        })
        ->get();

    // Count the total number of filtered summaries
    $totalCount = $filteredSummaries->count();

    // Pass the data to the PDF view
    $pdf = app('dompdf.wrapper')->loadView('pdf.summary_report', [
        'filteredSummaries' => $filteredSummaries,
        'totalCount' => $totalCount,
    ]);

    // Download the PDF
    return $pdf->download('summary_report.pdf');
}

}

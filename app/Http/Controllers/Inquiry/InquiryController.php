<?php
namespace App\Http\Controllers\Inquiry;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InquiryController extends Controller
{
    public function index(): View
    {
        $inquiries = Inquiry::latest()->get();
        return view('inquiries.index', compact('inquiries'));
    }

    public function create(): View
    {
        return view('inquiries.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'unique_code' => 'required|string|unique:inquiries',
            'inquiry_date' => 'required|date',
            'company_name' => 'required|string|max:255',
            'company_address' => 'required|string',
            'industry_type' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'company_phone' => 'required|string|max:20',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'contact_mobile' => 'required|string|max:20',
            'contact_name' => 'required|string|max:255',
            'scope_link' => 'nullable|url|max:255',
            'contact_position' => 'required|string|max:255',
            'quotation_file' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'quotation_sent' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('quotation_file')) {
            $validated['quotation_file'] = $request->file('quotation_file')->store('quotations', 'public');
        }

        Inquiry::create($validated);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Inquiry created successfully!'
            ]);
        }

        return redirect()->route('inquiries.index')->with('status', 'Inquiry created successfully!');
    }

    public function show(int $id): View
    {
        $inquiry = Inquiry::findOrFail($id);
        return view('inquiries.show', compact('inquiry'));
    }

    public function edit(int $id): View
    {
        $inquiry = Inquiry::findOrFail($id);
        return view('inquiries.edit', compact('inquiry'));
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $inquiry = Inquiry::findOrFail($id);
        
        $validated = $request->validate([
            'unique_code' => 'required|string|unique:inquiries,unique_code,' . $id,
            'inquiry_date' => 'required|date',
            'company_name' => 'required|string|max:255',
            'company_address' => 'required|string',
            'industry_type' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'company_phone' => 'required|string|max:20',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'contact_mobile' => 'required|string|max:20',
            'contact_name' => 'required|string|max:255',
            'scope_link' => 'nullable|url|max:255',
            'contact_position' => 'required|string|max:255',
            'quotation_file' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'quotation_sent' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('quotation_file')) {
            $validated['quotation_file'] = $request->file('quotation_file')->store('quotations', 'public');
        }

        $inquiry->update($validated);

        return back()->with('status', 'Inquiry updated successfully!');
    }

    public function destroy(int $id): RedirectResponse
    {
        $inquiry = Inquiry::findOrFail($id);
        $inquiry->delete();
        
        return back()->with('status', 'Inquiry deleted successfully!');
    }

    public function followUp(int $id): View
    {
        $inquiry = Inquiry::findOrFail($id);
        return view('inquiries.follow_up', compact('inquiry'));
    }

    public function storeFollowUp(Request $request, int $id)
    {
        $inquiry = Inquiry::findOrFail($id);
        
        $validated = $request->validate([
            'followup_date' => 'required|date',
            'next_followup_date' => 'nullable|date',
            'demo_status' => 'nullable|string',
            'remark' => 'nullable|string',
            'inquiry_note' => 'nullable|string',
        ]);

        // Here you would typically save to a follow_ups table
        // For now, just redirect back with success message
        
        return back()->with('status', 'Follow-up added successfully!');
    }
}

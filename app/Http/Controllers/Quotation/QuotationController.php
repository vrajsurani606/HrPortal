<?php
namespace App\Http\Controllers\Quotation;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use App\Models\Quotation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class QuotationController extends Controller
{
    public function index(): View
    {
        return view('quotations.index');
    }

    public function create(): View
    {
        return view('quotations.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'inquiry_id'       => 'nullable|exists:inquiries,id',
            'unique_code'      => 'nullable|string|max:255',
            'quotation_title'  => 'nullable|string|max:255',
            'quotation_date'   => 'nullable|date',
            'customer_type'    => 'nullable|string|max:255',
            'customer_id'      => 'nullable|integer',
            'gst_no'           => 'nullable|string|max:255',
            'pan_no'           => 'nullable|string|max:255',
            'company_name'     => 'nullable|string|max:255',
            'company_type'     => 'nullable|string|max:255',
            'nature_of_work'   => 'nullable|string|max:255',
            'city'             => 'nullable|string|max:255',
            'scope_of_work'    => 'nullable|string',
            'address'          => 'nullable|string',
            'contact_person_1' => 'nullable|string|max:255',
            'contact_number_1' => 'nullable|string|max:20',
            'position_1'       => 'nullable|string|max:255',
            'contract_copy'    => 'nullable|file|mimes:pdf,doc,docx,png,jpg,jpeg|max:4096',
            'contract_details' => 'nullable|string',
            'company_email'    => 'nullable|email|max:255',
            'company_password' => 'nullable|string|max:255',
            'amc_start_date'   => 'nullable|date',
            'amc_amount'       => 'nullable|numeric',
            'project_start_date' => 'nullable|date',
            'completion_time'  => 'nullable|string|max:255',
            'retention_time'   => 'nullable|string|max:255',
            'retention_amount' => 'nullable|numeric',
            'tentative_complete_date' => 'nullable|date',
            'contract_amount'  => 'nullable|numeric',
        ]);

        // Handle contract copy upload
        if ($request->hasFile('contract_copy')) {
            $validated['contract_copy_path'] = $request->file('contract_copy')->store('quotations/contracts', 'public');
        }

        // Default status
        $validated['status'] = 'draft';

        $quotation = Quotation::create($validated);

        return redirect()
            ->route('quotations.show', $quotation->id)
            ->with('success', 'Quotation saved');
    }

    public function show(int $id): View
    {
        $quotation = Quotation::findOrFail($id);
        return view('quotations.show', compact('quotation'));
    }

    public function edit(int $id): View
    {
        $quotation = Quotation::findOrFail($id);
        return view('quotations.edit', compact('quotation'));
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $quotation = Quotation::findOrFail($id);

        $validated = $request->validate([
            'quotation_title'  => 'nullable|string|max:255',
            'quotation_date'   => 'nullable|date',
            'customer_type'    => 'nullable|string|max:255',
            'customer_id'      => 'nullable|integer',
            'gst_no'           => 'nullable|string|max:255',
            'pan_no'           => 'nullable|string|max:255',
            'company_name'     => 'nullable|string|max:255',
            'company_type'     => 'nullable|string|max:255',
            'nature_of_work'   => 'nullable|string|max:255',
            'city'             => 'nullable|string|max:255',
            'scope_of_work'    => 'nullable|string',
            'address'          => 'nullable|string',
            'contact_person_1' => 'nullable|string|max:255',
            'contact_number_1' => 'nullable|string|max:20',
            'position_1'       => 'nullable|string|max:255',
            'contract_copy'    => 'nullable|file|mimes:pdf,doc,docx,png,jpg,jpeg|max:4096',
            'contract_details' => 'nullable|string',
            'company_email'    => 'nullable|email|max:255',
            'company_password' => 'nullable|string|max:255',
            'amc_start_date'   => 'nullable|date',
            'amc_amount'       => 'nullable|numeric',
            'project_start_date' => 'nullable|date',
            'completion_time'  => 'nullable|string|max:255',
            'retention_time'   => 'nullable|string|max:255',
            'retention_amount' => 'nullable|numeric',
            'tentative_complete_date' => 'nullable|date',
            'contract_amount'  => 'nullable|numeric',
            'status'           => 'nullable|string|max:50',
        ]);

        if ($request->hasFile('contract_copy')) {
            $validated['contract_copy_path'] = $request->file('contract_copy')->store('quotations/contracts', 'public');
        }

        $quotation->update($validated);

        return redirect()
            ->route('quotations.show', $quotation->id)
            ->with('success', 'Quotation updated');
    }

    public function destroy(int $id): RedirectResponse
    {
        return back()->with('success', 'Quotation deleted');
    }

    public function createFromInquiry(int $id): View
    {
        $inquiry = Inquiry::findOrFail($id);
        return view('quotations.create', compact('inquiry'));
    }
}

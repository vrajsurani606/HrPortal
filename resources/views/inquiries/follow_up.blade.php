@extends('layouts.macos')
@section('page_title', 'Follow Up')
@section('content')
    <div class="Rectangle-30">
        <!-- Inquiry Details -->
        <div class="hrp-form grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-5" style="margin-bottom: 30px;">
            <div>
                <label class="hrp-label">Unique Code:</label>
                <input class="Rectangle-29" value="{{ $inquiry->unique_code ?? 'CMS/LEAD/OO22' }}" readonly>
            </div>
            <div>
                <label class="hrp-label">Inquiry Date:</label>
                <input class="Rectangle-29"
                    value="{{ $inquiry->inquiry_date ? $inquiry->inquiry_date->format('Y-m-d') : 'Select your Date' }}"
                    >
            </div>

            <div>
                <label class="hrp-label">Company Name:</label>
                <input class="Rectangle-29" value="{{ $inquiry->company_name ?? 'Enter your company name' }}" >
            </div>
            <div>
                <label class="hrp-label">Company Address:</label>
                <textarea class="Rectangle-29 Rectangle-29-textarea" 
                    style="height:58px;resize:none;">{{ $inquiry->company_address ?? 'Enter Your Address' }}</textarea>
            </div>

            <div>
                <label class="hrp-label">Industry Type:</label>
                <input class="Rectangle-29" value="{{ $inquiry->industry_type ?? 'Enter Position' }}" >
            </div>
            <div>
                <label class="hrp-label">Email:</label>
                <select class="Rectangle-29-select" disabled>
                    <option>{{ $inquiry->email ?? 'Select your Option' }}</option>
                </select>
            </div>

            <div>
                <label class="hrp-label">Company Mo. No.:</label>
                <input class="Rectangle-29" value="{{ $inquiry->company_phone ?? 'Enter No of Exp. Like : 2.5' }}" >
            </div>
            <div>
                <label class="hrp-label">City:</label>
                <input class="Rectangle-29" value="{{ $inquiry->city ?? 'Enter Experience Previous Company Name' }}"
                    >
            </div>

            <div>
                <label class="hrp-label">State:</label>
                <input class="Rectangle-29" value="{{ $inquiry->state ?? 'Enter Salary' }}" >
            </div>
            <div>
                <label class="hrp-label">Contact Person Mobile No:</label>
                <input class="Rectangle-29" value="{{ $inquiry->contact_mobile ?? 'Enter Contact Person Mobile No' }}"
                    >
            </div>

            <div>
                <label class="hrp-label">Contact Person Name:</label>
                <input class="Rectangle-29" value="{{ $inquiry->contact_name ?? 'Enter Contact Person Name' }}" >
            </div>
            <div>
                <label class="hrp-label">Scope Link:</label>
                <input class="Rectangle-29" value="{{ $inquiry->scope_link ?? 'Enter Scope Link' }}" >
            </div>

            <div>
                <label class="hrp-label">Contact Person Position:</label>
                <input class="Rectangle-29" value="{{ $inquiry->contact_position ?? 'Enter Contact Person Position' }}"
                    >
            </div>
            <div>
                <label class="hrp-label">Quotation Upload:</label>
                <div class="upload-pill">
                    <div class="upload-display"
                        style="display:flex;align-items:center;justify-content:space-between;background:#fff;border:1px solid #e8e8e8;border-radius:413px;padding:16px 24px;height:58px;box-sizing:border-box;opacity:0.6;">
                        <span class="filename" style="color:#9ca3af;font-size:15px;">No file Chosen</span>
                        <span class="choose"
                            style="background:#f3f4f6;padding:8px 16px;border-radius:20px;font-size:14px;font-weight:600;color:#374151;">Choose
                            File</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="Rectangle-30">
        <!-- Previous Followup List -->
        {{-- <div style="background: #f8f9fa; border-radius: 12px; padding: 24px; margin-bottom: 24px;"> --}}
            <h3 style="margin: 0 0 20px 0; font-size: 18px; font-weight: 600; color: #333;">Previous Followup List</h3>
            <table style="width: 100%; border-collapse: collapse; background: white; border-radius: 8px; overflow: hidden;">
                <thead>
                    <tr>
                        <th
                            style="padding: 12px; text-align: left; background: #f8f9fa; font-weight: 600; color: #333; border-bottom: 1px solid #eee;">
                            Action</th>
                        <th
                            style="padding: 12px; text-align: left; background: #f8f9fa; font-weight: 600; color: #333; border-bottom: 1px solid #eee;">
                            Serial No.</th>
                        <th
                            style="padding: 12px; text-align: left; background: #f8f9fa; font-weight: 600; color: #333; border-bottom: 1px solid #eee;">
                            Is Confirm</th>
                        <th
                            style="padding: 12px; text-align: left; background: #f8f9fa; font-weight: 600; color: #333; border-bottom: 1px solid #eee;">
                            Remark</th>
                        <th
                            style="padding: 12px; text-align: left; background: #f8f9fa; font-weight: 600; color: #333; border-bottom: 1px solid #eee;">
                            Followup Date</th>
                        <th
                            style="padding: 12px; text-align: left; background: #f8f9fa; font-weight: 600; color: #333; border-bottom: 1px solid #eee;">
                            Next Date</th>
                        <th
                            style="padding: 12px; text-align: left; background: #f8f9fa; font-weight: 600; color: #333; border-bottom: 1px solid #eee;">
                            Demo Status</th>
                        <th
                            style="padding: 12px; text-align: left; background: #f8f9fa; font-weight: 600; color: #333; border-bottom: 1px solid #eee;">
                            Date & Time</th>
                        <th
                            style="padding: 12px; text-align: left; background: #f8f9fa; font-weight: 600; color: #333; border-bottom: 1px solid #eee;">
                            Code</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="padding: 12px; border-bottom: 1px solid #eee;"><span
                                style="display: inline-block; width: 12px; height: 12px; border-radius: 50%; background: #dc3545;"></span>
                        </td>
                        <td style="padding: 12px; border-bottom: 1px solid #eee;">1</td>
                        <td style="padding: 12px; border-bottom: 1px solid #eee;">No</td>
                        <td style="padding: 12px; border-bottom: 1px solid #eee;">Assigned</td>
                        <td style="padding: 12px; border-bottom: 1px solid #eee;">16-07-2025</td>
                        <td style="padding: 12px; border-bottom: 1px solid #eee;">-</td>
                        <td style="padding: 12px; border-bottom: 1px solid #eee;">No</td>
                        <td style="padding: 12px; border-bottom: 1px solid #eee;">No</td>
                        <td style="padding: 12px; border-bottom: 1px solid #eee;">CMS/INQ/OO10</td>
                    </tr>
                    <tr>
                        <td style="padding: 12px; border-bottom: 1px solid #eee;"><span
                                style="display: inline-block; width: 12px; height: 12px; border-radius: 50%; background: #28a745;"></span>
                        </td>
                        <td style="padding: 12px; border-bottom: 1px solid #eee;">2</td>
                        <td style="padding: 12px; border-bottom: 1px solid #eee;">Yes</td>
                        <td style="padding: 12px; border-bottom: 1px solid #eee;">Assigned</td>
                        <td style="padding: 12px; border-bottom: 1px solid #eee;">25-07-2025</td>
                        <td style="padding: 12px; border-bottom: 1px solid #eee;">16-08-2025</td>
                        <td style="padding: 12px; border-bottom: 1px solid #eee;">Yes</td>
                        <td style="padding: 12px; border-bottom: 1px solid #eee;">Yes</td>
                        <td style="padding: 12px; border-bottom: 1px solid #eee;">CMS/INQ/OO07</td>
                    </tr>
                </tbody>
            </table>
            {{--
        </div> --}}
    </div>
    <div class="Rectangle-30">
        <!-- Add Followup -->
        {{-- <div style="background: #f8f9fa; border-radius: 12px; padding: 24px;"> --}}
            <h3 style="margin: 0 0 20px 0; font-size: 18px; font-weight: 600; color: #333;">Add Followup</h3>
            <form method="POST" action="{{ route('inquiry.follow-up.store', $inquiry->id ?? 1) }}"
                class="hrp-form grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-5">
                @csrf
                <div>
                    <label class="hrp-label">Code:</label>
                    <input class="Rectangle-29" name="code" value="{{ $inquiry->unique_code ?? 'CMS/INQ/OO01' }}" >
                </div>
                <div>
                    <label class="hrp-label">Follow Up Date:</label>
                    <input type="date" class="Rectangle-29" name="followup_date">
                </div>
                <div>
                    <label class="hrp-label">Next Follow Up Date:</label>
                    <input type="date" class="Rectangle-29" name="next_followup_date">
                </div>
                <div>
                    <label class="hrp-label">Demo Status:</label>
                    <select class="Rectangle-29-select" name="demo_status">
                        <option value="">Select Status</option>
                        <option value="yes">Yes</option>
                        <option value="no">No</option>
                    </select>
                </div>

                <div>
                    <label class="hrp-label">Remark:</label>
                    <textarea class="Rectangle-29 Rectangle-29-textarea" name="remark" placeholder="Enter Remark"
                        style="height:80px;resize:vertical;"></textarea>
                </div>
                <div>
                    <label class="hrp-label">Inquiry:</label>
                    <textarea class="Rectangle-29 Rectangle-29-textarea" name="inquiry_note" placeholder="Enter Inquiry"
                        style="height:80px;resize:vertical;"></textarea>
                </div>

                <div class="md:col-span-2">
                    <div style="display:flex;justify-content:flex-end;margin-top:30px;">
                        <button type="submit" class="inquiry-submit-btn">Add Follow Up</button>
                    </div>
                </div>
            </form>
            {{--
        </div> --}}
    </div>
@endsection

@section('breadcrumb')
    <a class="hrp-bc-home" href="{{ route('dashboard') }}">Dashboard</a>
    <span class="hrp-bc-sep">›</span>
    <a href="{{ route('inquiries.index') }}">Inquiries</a>
    <span class="hrp-bc-sep">›</span>
    <span class="hrp-bc-current">Follow Up</span>
@endsection
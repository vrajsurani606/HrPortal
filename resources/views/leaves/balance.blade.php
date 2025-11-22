@extends('layouts.macos')
@section('page_title', 'Leave Balance')

@section('content')
<div class="hrp-content">
  <div style="margin-bottom: 30px;">
    <h2 style="margin: 0 0 10px 0; font-size: 28px; font-weight: 700; color: #1f2937;">Leave Balance - {{ now()->year }}</h2>
    <p style="margin: 0; color: #6b7280; font-size: 14px;">View your paid leave allocation and usage</p>
  </div>

  <!-- Summary Cards -->
  <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-bottom: 30px;">
    <!-- Total Paid Leave Card -->
    <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 12px; padding: 20px; color: white; box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);">
      <div style="font-size: 12px; opacity: 0.9; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px;">Total Paid Leave</div>
      <div style="font-size: 32px; font-weight: 700; margin-bottom: 8px;">{{ $leaveBalance->paid_leave_total }}</div>
      <div style="font-size: 13px; opacity: 0.85;">12 days per year (1 per month)</div>
    </div>

    <!-- Used Paid Leave Card -->
    <div style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); border-radius: 12px; padding: 20px; color: white; box-shadow: 0 4px 15px rgba(245, 87, 108, 0.3);">
      <div style="font-size: 12px; opacity: 0.9; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px;">Used This Year</div>
      <div style="font-size: 32px; font-weight: 700; margin-bottom: 8px;">{{ $leaveBalance->paid_leave_used }}</div>
      <div style="font-size: 13px; opacity: 0.85;">Casual: {{ $leaveBalance->casual_leave_used }} | Medical: {{ $leaveBalance->medical_leave_used }}</div>
    </div>

    <!-- Available Paid Leave Card -->
    <div style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); border-radius: 12px; padding: 20px; color: white; box-shadow: 0 4px 15px rgba(79, 172, 254, 0.3);">
      <div style="font-size: 12px; opacity: 0.9; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px;">Available Balance</div>
      <div style="font-size: 32px; font-weight: 700; margin-bottom: 8px;">{{ $leaveBalance->paid_leave_balance }}</div>
      <div style="font-size: 13px; opacity: 0.85;">Remaining for this year</div>
    </div>

    <!-- Current Month Available Card -->
    <div style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); border-radius: 12px; padding: 20px; color: white; box-shadow: 0 4px 15px rgba(67, 233, 123, 0.3);">
      <div style="font-size: 12px; opacity: 0.9; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px;">{{ now()->format('F') }} Available</div>
      <div style="font-size: 32px; font-weight: 700; margin-bottom: 8px;">{{ $leaveBalance->getMonthlyAvailable() }}</div>
      <div style="font-size: 13px; opacity: 0.85;">This month's allocation</div>
    </div>
  </div>

  <!-- Quarterly Overview -->
  <div style="background: white; border-radius: 12px; padding: 25px; margin-bottom: 30px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
    <h3 style="margin: 0 0 20px 0; font-size: 18px; font-weight: 700; color: #1f2937;">Quarterly Breakdown</h3>
    
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px;">
      @foreach($quarterlyBreakdown as $q => $quarter)
      <div style="border: 2px solid {{ $quarter['is_current'] ? '#667eea' : '#e5e7eb' }}; border-radius: 10px; padding: 15px; background: {{ $quarter['is_current'] ? '#f0f4ff' : '#f9fafb' }};">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
          <div style="font-weight: 700; color: #1f2937;">{{ $quarter['name'] }}</div>
          @if($quarter['is_current'])
          <span style="background: #667eea; color: white; padding: 2px 8px; border-radius: 12px; font-size: 11px; font-weight: 600;">CURRENT</span>
          @endif
        </div>
        
        <div style="margin-bottom: 10px;">
          <div style="display: flex; justify-content: space-between; font-size: 13px; margin-bottom: 5px;">
            <span style="color: #6b7280;">Used:</span>
            <span style="font-weight: 600; color: #ef4444;">{{ $quarter['used'] }} days</span>
          </div>
          <div style="display: flex; justify-content: space-between; font-size: 13px; margin-bottom: 5px;">
            <span style="color: #6b7280;">Available:</span>
            <span style="font-weight: 600; color: #10b981;">{{ $quarter['available'] }} days</span>
          </div>
          @if($quarter['rollover'] > 0)
          <div style="display: flex; justify-content: space-between; font-size: 13px;">
            <span style="color: #6b7280;">Rollover:</span>
            <span style="font-weight: 600; color: #f59e0b;">+{{ $quarter['rollover'] }} days</span>
          </div>
          @endif
        </div>
        
        <!-- Progress Bar -->
        <div style="background: #e5e7eb; border-radius: 6px; height: 6px; overflow: hidden;">
          <div style="background: linear-gradient(90deg, #ef4444, #f59e0b, #10b981); height: 100%; width: {{ min(100, ($quarter['used'] / $quarter['total']) * 100) }}%;"></div>
        </div>
      </div>
      @endforeach
    </div>
  </div>

  <!-- Monthly Breakdown -->
  <div style="background: white; border-radius: 12px; padding: 25px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
    <h3 style="margin: 0 0 20px 0; font-size: 18px; font-weight: 700; color: #1f2937;">Monthly Breakdown</h3>
    
    <div style="overflow-x: auto;">
      <table style="width: 100%; border-collapse: collapse;">
        <thead>
          <tr style="border-bottom: 2px solid #e5e7eb;">
            <th style="text-align: left; padding: 12px; font-weight: 600; color: #6b7280; font-size: 13px;">Month</th>
            <th style="text-align: center; padding: 12px; font-weight: 600; color: #6b7280; font-size: 13px;">Allocation</th>
            <th style="text-align: center; padding: 12px; font-weight: 600; color: #6b7280; font-size: 13px;">Used</th>
            <th style="text-align: center; padding: 12px; font-weight: 600; color: #6b7280; font-size: 13px;">Available</th>
            <th style="text-align: center; padding: 12px; font-weight: 600; color: #6b7280; font-size: 13px;">Status</th>
          </tr>
        </thead>
        <tbody>
          @foreach($monthlyBreakdown as $month => $data)
          <tr style="border-bottom: 1px solid #f3f4f6; background: {{ $data['is_current'] ? '#f0f4ff' : 'white' }};">
            <td style="padding: 12px; font-weight: {{ $data['is_current'] ? '600' : '500' }}; color: #1f2937;">
              {{ $data['name'] }}
              @if($data['is_current'])
              <span style="background: #667eea; color: white; padding: 2px 6px; border-radius: 4px; font-size: 10px; margin-left: 8px;">NOW</span>
              @endif
            </td>
            <td style="padding: 12px; text-align: center; color: #6b7280;">
              <span style="background: #f3f4f6; padding: 4px 8px; border-radius: 4px; font-weight: 600;">{{ $data['total'] }} day</span>
            </td>
            <td style="padding: 12px; text-align: center;">
              <span style="color: #ef4444; font-weight: 600;">{{ $data['used'] }}</span>
            </td>
            <td style="padding: 12px; text-align: center;">
              <span style="color: #10b981; font-weight: 600;">{{ $data['available'] }}</span>
            </td>
            <td style="padding: 12px; text-align: center;">
              @if($data['available'] > 0)
              <span style="background: #d1fae5; color: #065f46; padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: 600;">Available</span>
              @elseif($data['used'] >= $data['total'])
              <span style="background: #fee2e2; color: #991b1b; padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: 600;">Used</span>
              @else
              <span style="background: #fef3c7; color: #92400e; padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: 600;">Partial</span>
              @endif
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

  <!-- Leave Types Info -->
  <div style="margin-top: 30px; padding: 20px; background: #f0f9ff; border-left: 4px solid #3b82f6; border-radius: 8px;">
    <h4 style="margin: 0 0 12px 0; font-size: 14px; font-weight: 700; color: #1e40af;">Leave Types</h4>
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; font-size: 13px;">
      <div>
        <span style="font-weight: 600; color: #1e40af;">Casual Leave (Paid)</span>
        <p style="margin: 5px 0 0 0; color: #3b82f6;">{{ $leaveBalance->casual_leave_used }} days used</p>
      </div>
      <div>
        <span style="font-weight: 600; color: #1e40af;">Medical Leave (Paid)</span>
        <p style="margin: 5px 0 0 0; color: #3b82f6;">{{ $leaveBalance->medical_leave_used }} days used</p>
      </div>
      <div>
        <span style="font-weight: 600; color: #1e40af;">Personal Leave (Unpaid)</span>
        <p style="margin: 5px 0 0 0; color: #3b82f6;">{{ $leaveBalance->personal_leave_used }} days used (Unlimited)</p>
      </div>
    </div>
  </div>
</div>

<style>
  .hrp-content {
    padding: 20px;
    max-width: 1400px;
    margin: 0 auto;
  }
</style>
@endsection

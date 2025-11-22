<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Attendance;
use App\Models\Leave;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // ========== KPI STATS - ALL DYNAMIC ==========
        
        // 1. EMPLOYEES - Real count with growth
        $totalEmployees = Employee::count();
        $lastMonthEmployees = Employee::where('created_at', '<', now()->startOfMonth())->count();
        $employeeDelta = $lastMonthEmployees > 0 ? round((($totalEmployees - $lastMonthEmployees) / $lastMonthEmployees) * 100) : 0;

        // 2. PROJECTS - Real count (check if table exists)
        $totalProjects = 0;
        $projectDelta = 0;
        try {
            if (DB::getSchemaBuilder()->hasTable('projects')) {
                $totalProjects = DB::table('projects')->count();
                $lastMonthProjects = DB::table('projects')->where('created_at', '<', now()->startOfMonth())->count();
                $projectDelta = $lastMonthProjects > 0 ? round((($totalProjects - $lastMonthProjects) / $lastMonthProjects) * 100) : 0;
            }
        } catch (\Exception $e) {
            $totalProjects = 0;
        }

        // 3. PENDING TASKS - Real ticket counts
        $pendingTasks = Ticket::whereIn('status', ['pending', 'open'])->count();
        $urgentTasks = Ticket::whereIn('priority', ['urgent', 'high'])->count();

        // 4. ATTENDANCE TODAY - Real attendance data
        $today = now()->toDateString();
        $presentToday = Attendance::whereDate('date', $today)
            ->whereIn('status', ['present', 'late', 'early_leave'])
            ->count();
        $attendancePercent = $totalEmployees > 0 ? round(($presentToday / $totalEmployees) * 100) : 0;

        $stats = [
            'employees' => $totalEmployees,
            'delta_employees' => ($employeeDelta >= 0 ? '+' : '') . $employeeDelta . '%',
            'projects' => $totalProjects,
            'delta_projects' => ($projectDelta >= 0 ? '+' : '') . $projectDelta . '%',
            'open_positions' => $pendingTasks,
            'urgent_priority' => $urgentTasks,
            'attendance_percent' => $attendancePercent . '%',
            'attendance_present' => $presentToday . '/' . $totalEmployees,
        ];

        // ========== NOTIFICATIONS - DYNAMIC ==========
        $notifications = [];
        
        // Pending leaves
        $pendingLeaves = Leave::where('status', 'pending')->count();
        if ($pendingLeaves > 0) {
            $notifications[] = [
                'title' => $pendingLeaves . ' pending leave request' . ($pendingLeaves > 1 ? 's' : ''),
                'time' => 'Now'
            ];
        }
        
        // Recent tickets (last 24 hours)
        $recentTicketsCount = Ticket::where('created_at', '>=', now()->subHours(24))->count();
        if ($recentTicketsCount > 0) {
            $notifications[] = [
                'title' => $recentTicketsCount . ' new ticket' . ($recentTicketsCount > 1 ? 's' : ''),
                'time' => '24h'
            ];
        }

        // Absent employees today
        $absentToday = $totalEmployees - $presentToday;
        if ($absentToday > 0) {
            $notifications[] = [
                'title' => $absentToday . ' employee' . ($absentToday > 1 ? 's' : '') . ' absent today',
                'time' => 'Today'
            ];
        }

        // ========== RECENT INQUIRIES - DYNAMIC ==========
        $recentInquiries = [];
        try {
            if (DB::getSchemaBuilder()->hasTable('inquiries')) {
                $inquiries = DB::table('inquiries')
                    ->orderBy('created_at', 'desc')
                    ->limit(6)
                    ->get();
                
                foreach ($inquiries as $inq) {
                    $recentInquiries[] = [
                        'company' => $inq->company_name ?? 'N/A',
                        'person' => $inq->person_name ?? '—',
                        'phone' => $inq->phone ?? '—',
                        'date' => isset($inq->created_at) ? Carbon::parse($inq->created_at)->format('M d') : '—',
                        'next' => isset($inq->next_followup_date) ? Carbon::parse($inq->next_followup_date)->format('M d') : '—',
                        'status' => $inq->status ?? 'New',
                        'demo' => isset($inq->demo_date) ? Carbon::parse($inq->demo_date)->format('M d, Y | h:i A') : '—',
                    ];
                }
            }
        } catch (\Exception $e) {
            // Table doesn't exist - leave empty
        }

        // ========== RECENT TICKETS - DYNAMIC ==========
        $recentTickets = [];
        $tickets = Ticket::with('assignedEmployee')->orderBy('created_at', 'desc')->limit(6)->get();
        
        foreach ($tickets as $idx => $ticket) {
            // Determine priority color based on actual data
            $priorityColor = 'blue'; // default
            if (in_array($ticket->priority, ['urgent', 'high'])) {
                $priorityColor = 'orange';
            } elseif ($ticket->status === 'closed') {
                $priorityColor = 'green';
            }

            $recentTickets[] = [
                'id' => $ticket->id,
                'serial' => $idx + 1,
                'title' => $ticket->title ?? $ticket->subject ?? 'Untitled',
                'desc' => $ticket->description ?? 'No description',
                'status' => ucfirst($ticket->status ?? 'Open'),
                'work' => $ticket->assignedEmployee ? $ticket->assignedEmployee->name : 'Work Not Assigned',
                'priority' => $priorityColor,
                'category' => $ticket->category ?? 'General Inquiry',
                'customer' => $ticket->customer ?? 'Customer',
            ];
        }

        // ========== COMPANY CHART DATA - DYNAMIC ==========
        $companyData = [];
        try {
            if (DB::getSchemaBuilder()->hasTable('inquiries')) {
                // Get top companies by inquiry count
                $topCompanies = DB::table('inquiries')
                    ->select('company_name', DB::raw('COUNT(*) as count'))
                    ->whereNotNull('company_name')
                    ->groupBy('company_name')
                    ->orderByDesc('count')
                    ->limit(4)
                    ->get();
                
                foreach ($topCompanies as $company) {
                    $companyData[] = [
                        'name' => $company->company_name,
                        'value' => $company->count
                    ];
                }
            }
        } catch (\Exception $e) {
            // Fallback to default data if table doesn't exist
            $companyData = [
                ['name' => 'Geo Research', 'value' => 32],
                ['name' => 'Pure Dental', 'value' => 26],
                ['name' => 'Acme', 'value' => 22],
                ['name' => 'Globex', 'value' => 20],
            ];
        }

        // ========== NOTES - DYNAMIC FROM DATABASE ==========
        $users = Employee::select('id', 'name', 'photo_path')->orderBy('name')->get()->map(function($emp) {
            return [
                'id' => $emp->id, 
                'name' => $emp->name,
                'photo' => $emp->photo_path ? asset('storage/' . $emp->photo_path) : asset('new_theme/dist/img/avatar.png')
            ];
        })->toArray();

        // Check if notes table exists
        $systemNotes = [];
        $empNotes = [];
        
        try {
            if (DB::getSchemaBuilder()->hasTable('notes')) {
                // Get system notes
                $systemNotesData = DB::table('notes')
                    ->where('type', 'system')
                    ->orderBy('created_at', 'desc')
                    ->limit(4)
                    ->get();
                
                foreach ($systemNotesData as $note) {
                    $systemNotes[] = [
                        'text' => $note->content ?? $note->text ?? '',
                        'date' => isset($note->created_at) ? Carbon::parse($note->created_at)->format('M d, Y g:i A') : now()->format('M d, Y g:i A')
                    ];
                }

                // Get employee notes
                $empNotesData = DB::table('notes')
                    ->where('type', 'employee')
                    ->orderBy('created_at', 'desc')
                    ->limit(4)
                    ->get();
                
                foreach ($empNotesData as $note) {
                    $empNotes[] = [
                        'text' => $note->content ?? $note->text ?? '',
                        'date' => isset($note->created_at) ? Carbon::parse($note->created_at)->format('M d, Y') : now()->format('M d, Y'),
                        'assignees' => isset($note->assignees) ? json_decode($note->assignees, true) : array_slice(array_column($users, 'name'), 0, 2)
                    ];
                }
            }
        } catch (\Exception $e) {
            // Fallback to dynamic data based on actual system activity
            $systemNotes = [
                [
                    'text' => "Total " . $totalEmployees . " employees in the system. " . $pendingLeaves . " leave requests pending approval.",
                    'date' => now()->format('M d, Y g:i A')
                ],
                [
                    'text' => "Today's attendance: " . $presentToday . " out of " . $totalEmployees . " employees present (" . $attendancePercent . "%).",
                    'date' => now()->subHours(2)->format('M d, Y g:i A')
                ],
            ];

            $empNotes = [
                [
                    'text' => "Review and approve " . $pendingLeaves . " pending leave requests.",
                    'date' => now()->format('M d, Y'),
                    'assignees' => array_slice(array_column($users, 'name'), 0, 2)
                ],
                [
                    'text' => "Follow up on " . $urgentTasks . " urgent priority tickets.",
                    'date' => now()->addDays(1)->format('M d, Y'),
                    'assignees' => array_slice(array_column($users, 'name'), 0, 2)
                ],
            ];
        }

        $notes = [
            'notes' => $systemNotes,
            'emp' => $empNotes,
        ];

        return view('dashboard', compact('stats', 'notifications', 'recentInquiries', 'recentTickets', 'users', 'notes', 'companyData'));
    }
}

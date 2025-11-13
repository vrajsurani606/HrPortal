<?php
namespace App\Http\Controllers\Ticket;
use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Support\Facades\Schema;
use Illuminate\Http\Request;
class TicketController extends Controller
{
    public function index(Request $request)
    {
        $query = Ticket::query();

        if ($request->filled('company')) {
            $query->where('company', $request->string('company'));
        }
        if ($request->filled('ticket_type')) {
            $query->where('ticket_type', $request->string('ticket_type'));
        }
        if ($request->filled('q')) {
            $q = $request->string('q');
            $query->where(function ($sub) use ($q) {
                $sub->where('ticket_no', 'like', "%{$q}%")
                    ->orWhere('subject', 'like', "%{$q}%")
                    ->orWhere('customer', 'like', "%{$q}%")
                    ->orWhere('title', 'like', "%{$q}%")
                    ->orWhere('description', 'like', "%{$q}%");
            });
        }

        $perPage = (int) $request->get('per_page', 25);
        $tickets = $query->orderByDesc('id')->paginate($perPage)->appends($request->query());

        $companies = Schema::hasColumn('tickets','company')
            ? Ticket::query()->whereNotNull('company')->distinct()->pluck('company')
            : collect();
        $types = Schema::hasColumn('tickets','ticket_type')
            ? Ticket::query()->whereNotNull('ticket_type')->distinct()->pluck('ticket_type')
            : collect();

        return view('tickets.index', [
            'tickets' => $tickets,
            'companies' => $companies,
            'types' => $types,
        ]);
    }
    public function create(){ return view('tickets.create'); }
    public function store(Request $r){ return back()->with('success','Ticket saved'); }
    public function show($id){ return view('section',['name'=>'ticket-show']); }
    public function edit($id){ return view('section',['name'=>'ticket-edit']); }
    public function update(Request $r,$id){ return back()->with('success','Ticket updated'); }
    public function destroy(Ticket $ticket, Request $request)
    {
        $ticket->delete();
        if ($request->wantsJson()) {
            return response()->json(['success' => true]);
        }
        return back()->with('success','Ticket deleted');
    }
}

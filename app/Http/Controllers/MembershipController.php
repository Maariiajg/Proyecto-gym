<?php

namespace App\Http\Controllers;

use App\Models\Membership;
use App\Models\User;
use App\Http\Requests\StoreMembershipRequest;
use App\Http\Requests\UpdateMembershipRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Carbon\Carbon;

class MembershipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $memberships = Membership::with('user')->paginate(10);
        return view('memberships.index', compact('memberships'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $users = User::all();
        return view('memberships.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMembershipRequest $request): RedirectResponse
    {
        $data = $request->validated();
        
        // Lógica de auto-expiración
        if (Carbon::parse($data['end_date'])->isPast()) {
            $data['status'] = 'expired';
        }

        Membership::create($data);

        return redirect()->route('memberships.index')
            ->with('success', 'Membresía creada exitosamente.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Membership $membership): View
    {
        $users = User::all();
        return view('memberships.edit', compact('membership', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMembershipRequest $request, Membership $membership): RedirectResponse
    {
        $data = $request->validated();

        // Lógica de auto-expiración
        if (Carbon::parse($data['end_date'])->isPast()) {
            $data['status'] = 'expired';
        }

        $membership->update($data);

        return redirect()->route('memberships.index')
            ->with('success', 'Membresía actualizada exitosamente.');
    }
}

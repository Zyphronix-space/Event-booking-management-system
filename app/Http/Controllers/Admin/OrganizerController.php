<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Organizer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class OrganizerController extends Controller
{
    /**
     * Manage Users (Organizers) / Assign Roles use case — admin is the
     * only role allowed to create organizer accounts.
     */
    public function index()
    {
        $organizers = Organizer::orderBy('organizer_name')->get();

        return view('admin.organizers.index', compact('organizers'));
    }

    public function create()
    {
        return view('admin.organizers.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateOrganizer($request, null);
        $validated['password'] = Hash::make($validated['password']);

        Organizer::create($validated);

        return redirect()->route('admin.organizers.index')->with('status', 'Organizer added.');
    }

    public function edit(Organizer $organizer)
    {
        return view('admin.organizers.edit', compact('organizer'));
    }

    public function update(Request $request, Organizer $organizer)
    {
        $validated = $this->validateOrganizer($request, $organizer->organizer_id);

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $organizer->update($validated);

        return redirect()->route('admin.organizers.index')->with('status', 'Organizer updated.');
    }

    public function destroy(Organizer $organizer)
    {
        if ($organizer->events()->exists()) {
            return back()->withErrors(['organizer' => 'Cannot delete "' . $organizer->organizer_name . '": they have existing events. Delete or reassign those events first.']);
        }

        $organizer->delete();

        return redirect()->route('admin.organizers.index')->with('status', 'Organizer deleted.');
    }

    private function validateOrganizer(Request $request, ?int $ignoreId): array
    {
        $passwordRule = $ignoreId ? ['nullable', 'string', 'min:6'] : ['required', 'string', 'min:6'];

        return $request->validate([
            'organizer_name' => ['required', 'string', 'max:100'],
            'contact_email' => ['required', 'email', 'max:100'],
            'contact_number' => ['nullable', 'string', 'max:15'],
            'username' => ['required', 'string', 'max:50', Rule::unique('organizer', 'username')->ignore($ignoreId, 'organizer_id')],
            'password' => $passwordRule,
        ]);
    }
}

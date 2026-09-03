<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class CustomerController extends Controller
{
    /**
     * Manage Users (Customers) use case.
     */
    public function index()
    {
        $customers = Customer::orderBy('full_name')->get();

        return view('admin.customers.index', compact('customers'));
    }

    public function create()
    {
        return view('admin.customers.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateCustomer($request, null);
        $validated['password'] = Hash::make($validated['password']);

        Customer::create($validated);

        return redirect()->route('admin.customers.index')->with('status', 'Customer added.');
    }

    public function edit(Customer $customer)
    {
        return view('admin.customers.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $validated = $this->validateCustomer($request, $customer->customer_id);

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $customer->update($validated);

        return redirect()->route('admin.customers.index')->with('status', 'Customer updated.');
    }

    public function destroy(Customer $customer)
    {
        if ($customer->bookings()->exists()) {
            return back()->withErrors(['customer' => 'Cannot delete "' . $customer->full_name . '": they have existing bookings. Cancel those bookings first.']);
        }

        $customer->delete();

        return redirect()->route('admin.customers.index')->with('status', 'Customer deleted.');
    }

    private function validateCustomer(Request $request, ?int $ignoreId): array
    {
        $passwordRule = $ignoreId ? ['nullable', 'string', 'min:6'] : ['required', 'string', 'min:6'];

        return $request->validate([
            'full_name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:100'],
            'phone_number' => ['nullable', 'string', 'max:15'],
            'username' => ['required', 'string', 'max:50', Rule::unique('customer', 'username')->ignore($ignoreId, 'customer_id')],
            'password' => $passwordRule,
        ]);
    }
}

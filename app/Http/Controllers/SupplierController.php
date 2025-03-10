<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\File;
use App\Http\Controllers\IdGenerator;

class SupplierController extends Controller
{
    public function index()
    {
        $row = (int) request('row', 10);

        if ($row < 1 || $row > 100) {
            abort(400, 'The per-page parameter must be an integer between 1 and 100.');
        }

        return view('suppliers.index', [
            'suppliers' => Supplier::filter(request(['search']))
                ->sortable()
                ->paginate($row)
                ->appends(request()->query()),
        ]);
    }

    public function create()
    {
        return view('suppliers.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:suppliers',
            'phone' => 'required|unique:suppliers',
            'address' => 'nullable|string',
            'shopname' => 'nullable|string',
            'photo' => 'image|file|max:1024|nullable',
            'type' => 'nullable|string',
            'account_holder' => 'nullable|string',
            'account_number' => 'nullable|string',
            'bank_name' => 'nullable|string',
            'bank_branch' => 'nullable|string',
            'city' => 'nullable|string',
        ];
        
        $validatedData = $request->validate($rules);

        /**
         * Handle upload image with Storage.
         */
        if ($file = $request->file('photo')) {
            $image = $request->file('photo');
            $imageName = time().'.'.$image->getClientOriginalExtension();

            $image->move(public_path('images/supplier/'), $imageName);
            $validatedData['photo'] = $imageName;
        }

        Supplier::create($validatedData);

        return redirect()->route('suppliers.index')->with('success', 'Supplier created successfully');
    }

    // Show the form to edit the supplier
    public function edit($id)
    {
        $supplier = Supplier::findOrFail($id);

        return view('suppliers.edit', compact('supplier'));
    }

    public function show(Supplier $supplier)
    {
        return view('suppliers.show', [
            'supplier' => $supplier,
        ]);
    }

    // Update the supplier
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:suppliers,email,' . $id,
            'phone' => 'required|unique:suppliers,phone,' . $id,
            'address' => 'nullable|string',
            'shopname' => 'nullable|string',
            'photo' => 'nullable|image',
            'type' => 'nullable|string',
            'account_holder' => 'nullable|string',
            'account_number' => 'nullable|string',
            'bank_name' => 'nullable|string',
            'bank_branch' => 'nullable|string',
            'city' => 'nullable|string',
        ]);

        $supplier = Supplier::findOrFail($id);
        $supplier->update($request->all());

        return redirect()->route('suppliers.index')->with('success', 'Supplier updated successfully');
    }

    // Destroy the supplier
    public function destroy($id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();

        return redirect()->route('suppliers.index')->with('success', 'Supplier deleted successfully');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\File;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        // Get search keyword
        $search = $request->input('search');
        $row = $request->input('row', 10); // Default 10 rows per page

        // Query customers
        $customers = Customer::when($search, function ($query) use ($search) {
                return $query->where('name', 'LIKE', "%{$search}%")
                            ->orWhere('email', 'LIKE', "%{$search}%")
                            ->orWhere('phone', 'LIKE', "%{$search}%")
                            ->orWhere('shopname', 'LIKE', "%{$search}%")
                            ->orWhere('city', 'LIKE', "%{$search}%");
            })
            ->orderBy('id', 'desc')
            ->paginate($row);

        // Return view with data
        return view('customer.index', compact('customers'));
    }


    public function create()
    {
        return view('customer.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'photo' => 'nullable|image|file',
            'name' => 'required|string|max:50',
            'email' => 'required|email|max:50|unique:customers,email',
            'phone' => 'required|string|max:15|unique:customers,phone',
            'shopname' => 'required|string|max:50',
            'account_holder' => 'nullable|string|max:50',
            'account_number' => 'nullable|string|max:25',
            'bank_name' => 'nullable|string|max:25',
            'bank_branch' => 'nullable|string|max:50',
            'city' => 'required|string|max:50',
            'address' => 'required|string|max:100',
        ];

        $validatedData = $request->validate($rules);

        /**
         * Handle upload image with Storage.
         */
        if ($file = $request->file('photo')) {
            $image = $request->file('photo');
            $imageName = time().'.'.$image->getClientOriginalExtension();

            $image->move(public_path('images/customers'), $imageName);
            $validatedData['photo'] = $imageName;
        }

        Customer::create($validatedData);

        return Redirect::route('customer.index')->with('success', 'Customer has been created!');
    }

    public function show(Customer $customer)
    {
        return view('customer.show', ['customers' => $customer]);
    }

    public function edit(Customer $customer)
    {
        return view('customer.edit', [
            'customer' => $customer
        ]);
    }

    public function update(Request $request, Customer $customer)
    {
        $rules = [
            'photo' => 'image|file|max:1024',
            'name' => 'required|string|max:50',
            'email' => 'required|email|max:50|unique:customers,email,'.$customer->id,
            'phone' => 'required|string|max:15|unique:customers,phone,'.$customer->id,
            'shopname' => 'required|string|max:50',
            'account_holder' => 'max:50',
            'account_number' => 'max:25',
            'bank_name' => 'max:25',
            'bank_branch' => 'max:50',
            'city' => 'required|string|max:50',
            'address' => 'required|string|max:100',
        ];

        $validatedData = $request->validate($rules);

        /**
         * Handle upload image with Storage.
         */
        if ($file = $request->file('photo')) {
            $fileName = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $path = public_path('images/customers/');

            /**
             * Delete photo if exists.
             */
            if($customer->photo && file_exists($path . $customer->photo)){
                unlink($path . $customer->photo);
            }

            $file->move($path, $fileName);
            $validatedData['photo'] = $fileName;
        }

        $customer->fill($validatedData);

        if(!$customer->name){
            return back()->with('error', 'Customer Name is required!');
        }

        $customer->save();

        return Redirect::route('customer.index')->with('success', 'Customer has been updated!');
    }

    public function destroy(Customer $customer)
    {
        /**
         * Delete photo if exists.
         */
        if($customer->photo){
            $imagePath = public_path('images/' . $customer->photo);
    
            // Check if file exists before deleting
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }

        Customer::destroy($customer->id);

        return Redirect::route('customer.index')->with('success', 'Customer has been deleted!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // Start query with relationship
            $query = User::get();

            return DataTables::of($query)
                ->addIndexColumn()

                ->addColumn('action', function ($row) {
                    return '
                    <button class="btn btn-primary btn-sm editBtn" data-id="' . $row->id . '">Edit</button>
                    <button class="btn btn-danger btn-sm" data-action="delete" data-id="' . $row->id . '">Delete</button>
                ';
                })

                ->rawColumns(['action'])
                ->make(true);
        }

        return view('user.index');
    }
    public function create()
    {
        return view('user.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'user_type' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|confirmed',
            'mobile' => 'required|string|max:15|unique:users',
            'opening_balance' => 'nullable|numeric',
            'department' => 'nullable|string|max:255',
            'default_department' => 'nullable|string|max:255',
            'transaction_type' => 'required|in:credit,debit',
            'designation' => 'nullable|string|max:255',
            'salary' => 'nullable|numeric',
            'is_cad_designer' => 'nullable|boolean',
            'otp_to_mobile' => 'required|in:yes,no',
        ]);

        User::create([
            'type' => $request->user_type,
            'name' => $request->name,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'mobile' => $request->mobile,
            'opening_balance' => $request->opening_balance ?? 0,
            'department' => $request->department,
            'default_department' => $request->default_department,
            'transaction_type' => $request->transaction_type,
            'designation' => $request->designation,
            'salary' => $request->salary,
            'is_cad_designer' => $request->has('is_cad_designer'),
            'otp_to_mobile' => $request->has('otp_to_mobile'),
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        
        $request->validate([
            'user_type' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $id,
            'password' => 'nullable|string|confirmed',
            'mobile' => 'required|string|max:15|unique:users,mobile,' . $id,
            'opening_balance' => 'nullable|numeric',
            'department' => 'nullable|string|max:255',
            'default_department' => 'nullable|string|max:255',
            'transaction_type' => 'required|in:credit,debit',
            'designation' => 'nullable|string|max:255',
            'salary' => 'nullable|numeric',
            'is_cad_designer' => 'nullable|boolean',
            'otp_to_mobile' => 'required|in:yes,no',
        ]);

        $user = User::findOrFail($id);
        $user->type = $request->user_type;
        $user->name = $request->name;
        $user->username = $request->username;

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->mobile = $request->mobile;
        $user->opening_balance = $request->opening_balance ?? 0;
        $user->department = $request->department;
        $user->default_department = $request->default_department;
        $user->transaction_type = $request->transaction_type;
        $user->designation = $request->designation;
        $user->salary = $request->salary;
        $user->is_cad_designer = $request->has('is_cad_designer');
        $user->otp_to_mobile = $request->has('otp_to_mobile');
        $user->save();

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

       return response()->json([
            'success' => true,
            'message' => 'User deleted successfully!'
        ]);
    }
}

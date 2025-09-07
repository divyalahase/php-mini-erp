<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Company;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\AdminController;


class AdminController extends Controller
{
    
    public function dashboard()
    {
        return view('admin.dashboard');
    }

  
    public function companies()
    {
        $companies = Company::all();
        return view('admin.companies.index', compact('companies'));
    }

   
    public function createCompany()
    {
        return view('admin.companies.create');
    }

    public function storeCompany(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string',
        ]);

        Company::create($request->all());
        return redirect()->route('admin.companies')->with('success', 'Company created successfully');
    }

    
    public function users()
    {
        $users = User::all();
        $companies = Company::all();
        return view('admin.users.index', compact('users','companies'));
    }
    public function createUser()
    {
        $companies = Company::all();
        return view('admin.users.create', compact('companies'));
    }
    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|in:admin,sales,store_manager',
            'company_id' => 'nullable|exists:companies,id'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'company_id' => $request->company_id,
        ]);

        return redirect()->route('admin.users')->with('success', 'User created successfully');
    }
}


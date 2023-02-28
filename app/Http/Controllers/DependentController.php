<?php

namespace App\Http\Controllers;

use App\Models\Dependent;
use App\Exports\ExportUser;
use App\Imports\ImportUser;
use App\Models\ImportExport;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Exports\DependentExport;

use App\Imports\DependentImport;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DependentController extends Controller
{
    public function index()
    {
        return view('dependent.index');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'phone' => 'required|string|max:20',
            'image' => 'nullable|image|max:8192',
            'address' => 'required|string|max:255',
            'dob' => 'required|date',
        ]);

        $user = new Dependent;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->address = $request->input('address');
        $user->dob = $request->input('dob');

        // handle image upload if provided
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . $image->getClientOriginalName();
            $filepath = $image->storeAs('public/images', $filename);
            $user->image = $filename;
        }

        $user->save();

        return response()->json(['success' => true]);
    }

    public function getUsers()
    {
        $users = Dependent::all();
        return response()->json(['users' => $users]);
    }

    public function importView()
    {
        return view('excel_all.excel_view');
    }
    public function import() 
    {
        Excel::import(new DependentImport,request()->file('import_file'));
        return back();
    }

    public function export() 
    {
        return Excel::download(new DependentExport, 'dependent.xlsx');
    }

   
}

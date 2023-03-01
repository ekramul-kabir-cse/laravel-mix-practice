<?php

namespace App\Http\Controllers;

use App\Models\Info;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class InfoController extends Controller
{
    public function create()
    {
        return view('info.create');
    }
    public function store(Request $request)
    {
        // Validate input fields
        $validatedData = $request->validate([
            'title' => 'required',
            'subtitle' => 'required',
            'description' => 'required',
            'date' => 'required|date_format:Y-m-d',
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'address' => 'required',
        ], [
            'title.required' => 'The title field is required.',
            'subtitle.required' => 'The subtitle field is required.',
            'description.required' => 'The description field is required.',
            'date.required' => 'The date field is required.',
            'date.date_format' => 'The date field must be in the format yyyy-mm-dd.',
            'name.required' => 'The name field is required.',
            'email.required' => 'The email field is required.',
            'email.email' => 'The email must be a valid email address.',
            'phone.required' => 'The phone field is required.',
            'image.required' => 'The image field is required.',
            'image.image' => 'The image must be a valid image file.',
            'image.mimes' => 'The image must be a jpeg, png, jpg, gif, or svg file.',
            'image.max' => 'The image may not be larger than 2MB.',
            'address.required' => 'The address field is required.',
        ]);
        

        // Generate slug from title
        $slug = Str::slug($request->input('title'), '-');
        if (Info::where('slug', $slug)->exists()) {
            return redirect()->back()->withErrors(['slug' => 'The slug is already taken.'])->withInput();
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'.'.$image->extension();
            $image->move(public_path('images'), $imageName);
        }        
        // Save data to database
        $info = new Info();
        $info->title = $request->input('title');
        $info->subtitle = $request->input('subtitle');
        $info->description = $request->input('description');
        $info->slug = $slug;
        $info->date = $request->input('date');
        $info->name = $request->input('name');
        $info->email = $request->input('email');
        $info->phone = $request->input('phone');
        $info->image = $imageName;
        $info->address = $request->input('address');
        $info->save();

        // Set success message and redirect to homepage
        return redirect()->back()->with('success', 'Data has been saved successfully.');
    }

    public function index()
    {
        $info = Info::orderBY('id','DESC')->get();
        return view('info.index',compact('info'));
    }
}


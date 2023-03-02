<?php

namespace App\Http\Controllers;

use App\Models\Info;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            $imageName = time() . '.' . $image->extension();
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
        return redirect()->route('info.index')->with('alert', [
            'type' => 'success',
            'message' => 'Data has been saved successfully',
        ]);
    }

    public function index()
    {
        $info = Info::orderBY('id', 'DESC')->get();
        return view('info.index', compact('info'));
    }
    public function editInfo($id)
    {
        $info = Info::where('id', $id)->first();
        return view('info.edit', compact('info'));
    }

    public function updateInfo(Request $request, $id)
    {
        $info = Info::findOrFail($id);
        $data = $request->validate([
            'title' => 'required|string',
            'subtitle' => 'nullable|string',
            'description' => 'nullable|string',
            'date' => 'nullable|date',
            'name' => 'nullable|string',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
        ]);

        // Update slug if title is changed
        if ($request->filled('title') && $request->input('title') !== $info->title) {
            $slug = Str::slug($request->input('title'), '-');
            if (Info::where('slug', $slug)->exists()) {
                return redirect()->back()->withInput()->with('alert', ['type' => 'warning', 'message' => 'Slug already taken']);
            }
            $data['slug'] = $slug;
        } else {
            $data['slug'] = $info->slug;
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('images'), $imageName);
            // Delete old image if it exists
            if ($info->image) {
                Storage::delete('public/images/' . $info->image);
            }
            $data['image'] = $imageName;
        }

        $info->update($data);
        return redirect()->route('info.index')->with('alert', ['type' => 'success', 'message' => 'Data has been updated successfully']);
    }


    public function delete($id)
    {
        $info = Info::findOrFail($id);

        // Delete image file from storage
        if ($info->image) {
            Storage::delete('public/images/' . $info->image);
        }
        // Delete record from database
        $info->delete();
        return redirect()->route('info.index')->with('alert', ['type' => 'success', 'message' => 'Data has been deleted successfully']);
    }
}

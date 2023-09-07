<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Models\Organization;
use App\Models\Volunteer;
use App\Models\Review;

class EventController extends Controller
{
    public function uploadImage($image)
    {
        $filename = Str::uuid()->toString() . '-' . time() . '.' . $image->getClientOriginalExtension();
        $image->move('uploads/event/', $filename);

        return $filename;
    }

    public function getEvent()
    {
        return view('admin.pages.events.event', [
            'events' => Event::with('category')->latest()->get(),
            'categories' => Category::all(),
            'orgs'      =>  Organization::all(),
        ]);
    }

    public function storeEvent(Request $request)
    {
        $event = new Event();
        $event->name        =   $request->name;
        $event->location    =   $request->location;
        $event->description =   $request->description;
        $event->start       =   $request->time;
        $event->organize_by =   $request->organize_by;
        $event->cat_id      =   $request->cat_id;

        if($request->hasFile('image')) {
            $event->photo = $this->uploadImage($request->file('image'));
        } else {
            return "No image found";
        }

        $event->save();

        return redirect()->back()->with('status', 'Event created successfully');
    }

    public function updateEvent(Request $request, $id)
    {
        // return $request;

        $event = Event::find($id);
        $event->name        =   $request->name;
        $event->location    =   $request->location;
        $event->description =   $request->description;
        $event->start       =   $request->time;
        $event->organize_by =   $request->organize_by;
        $event->cat_id      =   $request->cat_id;

        if($request->hasFile('image')) {
            $event->photo = $this->uploadImage($request->file('image'));
        }

        $event->update();

        return redirect()->back()->with('status', 'Event updated successfully');
    }

    public function deleteEvent($id)
    {
        $event = Event::find($id);
        $event->delete();

        return redirect()->back()->with('status', 'Event deleted successfully');
    }

    // Volunteer

    public function getVolunteer()
    {
        // $volunteers = Volunteer::with('event')->get();

        return view('admin.pages.events.volunteer', [
            'volunteers' => Volunteer::all(),
        ]);
    }

    public function getReview()
    {
        return view('admin.pages.events.review', [
            'reviews' => Review::all(),
        ]);
    }

    // Category
    public function getCategory()
    {
        return view('admin.pages.events.category', [
            'categories' => Category::all(),
        ]);
    }

    public function storeCategory(Request $request)
    {
        $category = new Category();
        $category->cat_name = $request->name;
        $category->slug = Str::slug($request->name);

        $category->save();

        return redirect()->back()->with('status', 'Category created successfully');
    }

    public function updateCategory(Request $request, $id)
    {
        $category = Category::find($id);
        $category->cat_name = $request->name;

        $category->update();

        return redirect()->back()->with('status', 'Category updated successfully');
    }

    public function deleteCategory($id)
    {
        $category = Category::find($id);
        $category->delete();

        return redirect()->back()->with('status', 'Category deleted successfully');
    }
}

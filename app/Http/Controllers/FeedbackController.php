<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index()
    {
        $rows = Feedback::all();

        return view('admin.feedback.index', compact('rows'));
    }

    public function store()
    {
        $this->validate(request(), [
           'email' => 'required|email',
           'text' => 'required'
        ]);

        Feedback::create([
            'email' => request('email'),
            'text' => request('text'),
        ]);

        return redirect('/admin/feedback');
    }
}

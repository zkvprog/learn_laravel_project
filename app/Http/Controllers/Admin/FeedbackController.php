<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use function redirect;
use function request;
use function view;

class FeedbackController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

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

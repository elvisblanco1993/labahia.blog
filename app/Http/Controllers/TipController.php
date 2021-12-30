<?php

namespace App\Http\Controllers;

use App\Models\Tip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TipController extends Controller
{
    public function create()
    {
        return view('web.tips.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'nullable|email',
            'message' => 'required|min:50'
        ]);

        try {
            Tip::create($validated);
            $status = 'Thank you! We have received your message and someone from our team will review it in a few minutes.';
        } catch (\Throwable $th) {
            Log::error($th);
            Log::notice($validated);
            $status = 'There was an error while sending your message. Dont worry, we should still be able to see it and will reach back to you in case we need something else.';
        }
        return redirect('/tips/submit')->with('status', $status);
    }
}

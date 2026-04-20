<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    public function index()
    {
        return view('public.survey');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'profession' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|min:10',
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'profession.required' => 'Pekerjaan/Status wajib diisi.',
            'subject.required' => 'Subjek wajib diisi.',
            'rating.required' => 'Silakan berikan penilaian bintang Anda.',
            'comment.required' => 'Komentar atau saran wajib diisi.',
            'comment.min' => 'Komentar minimal 10 karakter.',
        ]);

        Feedback::create($validated);

        return redirect()->back()->with('success', 'Terima kasih atas partisipasi Anda! Masukan Anda sangat berharga bagi kami.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\FAQ;
use App\Models\Feedback;
use App\Models\Request as LegalRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PublicServiceController extends Controller
{
    public function faq()
    {
        $faqs = FAQ::where('is_published', true)->orderBy('order')->get();
        return view('public.service.faq', compact('faqs'));
    }

    public function permohonan()
    {
        return view('public.service.permohonan');
    }

    public function storePermohonan(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'category' => 'required|string',
            'message' => 'required|string',
        ]);

        $ticket = 'JDIH-' . date('Y') . '-' . strtoupper(Str::random(6));
        $validated['ticket_number'] = $ticket;
        $validated['status'] = 'pending';

        LegalRequest::create($validated);

        return redirect()->route('public.service.tracking')->with([
            'success' => 'Permohonan Anda berhasil dikirim.',
            'ticket' => $ticket
        ]);
    }

    public function tracking(Request $request)
    {
        $ticket = $request->get('ticket');
        $result = null;

        if ($ticket) {
            $result = LegalRequest::where('ticket_number', $ticket)->first();
        }

        return view('public.service.tracking', compact('result', 'ticket'));
    }

    public function feedback()
    {
        return view('public.service.feedback');
    }

    public function storeFeedback(Request $request)
    {
        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);

        Feedback::create($validated);

        return back()->with('success', 'Terima kasih atas masukan Anda!');
    }
}

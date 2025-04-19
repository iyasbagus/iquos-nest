<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\CreatorApplication;
use App\Notifications\CreatorApplicationRejected;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CreatorApplicationController extends Controller
{
    public function index()
    {
        $applications = CreatorApplication::latest()->paginate(10);
        $applicationTotals = CreatorApplication::count();
        return view('admin.creator-apply.index', compact('applications'));
    }

    public function create()
    {
        $user = Auth::user();
        return view('creator.creator-apply.apply', compact('user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'portofolio_link' => 'nullable|url',
            'preview_images.*' => 'nullable|image|mimes:jpg,jpeg,png,svg|max:5120',
            'asset_files.*' => 'required|file|mimes:zip,ai,psd,pdf,rar,eps|max:10240',
            'rejection_reason' => 'nullable',
        ]);

        $application = CreatorApplication::create([
            'user_id' => Auth::id(),
            'portfolio_link' => $request->portfolio_link,
            'status' => 'pending',
        ]);

        if ($request->hasFile('preview_images')) {
            foreach ($request->file('preview_images') as $image) {
                $fileName = now()->timestamp . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
                $application->addMedia($image)->preservingOriginal()->usingFileName($fileName)->toMediaCollection('preview_images', 'public');
            }
        }

        if ($request->hasFile('asset_files')) {
            foreach ($request->file('asset_files') as $file) {
                $fileName = now()->timestamp . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
                $application->addMedia($file)->preservingOriginal()->usingFileName($fileName)->toMediaCollection('asset_files', 'public');
            }
        }

        return redirect()->route('welcome')->with('success', 'Pengajuan berhasil dikirim. Tunggu konfirmasi dari admin');
    }

    public function approve($id)
    {
        $application = CreatorApplication::with('user')->findOrFail($id);

        $application->update(['status' => 'approved']);

        $user = $application->user;
        if (!$user) {
            return redirect()->back()->with('error', 'User tidak ditemukan untuk aplikasi ini.');
        }

        $user->assignRole('creator');

        return redirect()->back()->with('success', 'Pengajuan berhasil disetujui.');
    }

    public function reject(Request $request, $id)
    {
        $request->validate([
            'rejection_reason' => 'required|string|max:1000',
        ]);

        $application = CreatorApplication::findOrFail($id);

        $application->update([
            'status' => 'rejected',
            'rejection_reason' => $request->rejection_reason,
        ]);

        $application->user->notify(new CreatorApplicationRejected($request->rejection_reason));

        return redirect()->back()->with('error', 'Pengajuan ditolak.');
    }
}

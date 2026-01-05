<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreCertificateRequest;
use App\Http\Requests\UpdateCertificateRequest;

class CertificateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $certificates = Certificate::all();
        return view('admin.certificates.index', compact('certificates'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.certificates.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCertificateRequest $request)
    {
        $data = $request->only(['title', 'description']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('certificates', 'public');
        }

        Certificate::create($data);

        return redirect()->route('admin.certificates.index')->with('success', 'Certificate created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $certificate = Certificate::findOrFail($id);
        return view('admin.certificates.show', compact('certificate'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $certificate = Certificate::findOrFail($id);
        return view('admin.certificates.edit', compact('certificate'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCertificateRequest $request, string $id)
    {
        $certificate = Certificate::findOrFail($id);

        $data = $request->only(['title', 'description']);

        if ($request->hasFile('image')) {
            if ($certificate->image) {
                Storage::disk('public')->delete($certificate->image);
            }
            $data['image'] = $request->file('image')->store('certificates', 'public');
        }

        $certificate->update($data);

        return redirect()->route('admin.certificates.index')->with('success', 'Certificate updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $certificate = Certificate::findOrFail($id);

        if ($certificate->image) {
            Storage::disk('public')->delete($certificate->image);
        }

        $certificate->delete();

        return redirect()->route('admin.certificates.index')->with('success', 'Certificate deleted successfully.');
    }

    /**
     * Display the public certificate page with subjects and sub-subjects.
     */
    public function publicIndex()
    {
        $subjects = Subject::with('subSubjects')->where('status', 'active')->get();
        return view('certificate', compact('subjects'));
    }
}

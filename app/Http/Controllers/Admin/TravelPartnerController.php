<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TravelPartner;
use Illuminate\Http\Request;

class TravelPartnerController extends Controller
{
public function index(Request $request)
    {
        // Get filter values from request
        $search = $request->input('search');
        $status = $request->input('status');
        $tier = $request->input('tier');
        $apiHealth = $request->input('api_health');

        // Base query
        $query = TravelPartner::query();

        // Search functionality
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('company_name', 'like', "%{$search}%")
                  ->orWhere('api_type', 'like', "%{$search}%")
                  ->orWhere('contact_person', 'like', "%{$search}%")
                  ->orWhere('contact_email', 'like', "%{$search}%");
            });
        }

        // Status filter
        if ($status) {
            $query->where('status', $status);
        }

        // Tier filter
        if ($tier) {
            $query->where('partner_tier', $tier);
        }

        // API Health filter
        if ($apiHealth) {
            switch ($apiHealth) {
                case 'excellent':
                    $query->where('api_uptime', '>=', 95);
                    break;
                case 'good':
                    $query->whereBetween('api_uptime', [85, 94.99]);
                    break;
                case 'poor':
                    $query->where('api_uptime', '<', 85);
                    break;
            }
        }

        // Get stats for cards
        $stats = [
            'total_partners' => TravelPartner::count(),
            'active_partners' => TravelPartner::active()->count(),
            'monthly_revenue' => TravelPartner::active()->sum('monthly_revenue'),
            'avg_commission' => TravelPartner::active()->avg('commission_rate'),
            'new_this_month' => TravelPartner::whereMonth('created_at', now()->month)->count(),
            'revenue_growth' => TravelPartner::active()
                                    ->whereMonth('last_revenue_update', now()->month)
                                    ->avg('revenue_growth')
        ];

        // Get partners with pagination
        $partners = $query->latest()->paginate(10);

        return view('admin.travel-partners.index', compact('partners', 'stats'));
    }


    public function activate(TravelPartner $partner)
{
    $partner->activate();
    return redirect()->back()->with('success', 'Partner activated successfully');
}

public function suspend(TravelPartner $partner)
{
    $partner->suspend();
    return redirect()->back()->with('success', 'Partner suspended successfully');
}


    public function create()
    {
        return view('admin.travel-partners.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:travel_partners',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'city' => 'required|string|max:100',
            'country' => 'required|string|max:100',
            'commission_rate' => 'required|numeric|min:0|max:100',
            'status' => 'required|in:active,inactive',
        ]);

        TravelPartner::create($validated);

        return redirect()->route('admin.travel-partners.index')
                        ->with('success', 'Travel partner created successfully!');
    }

    public function edit(TravelPartner $partner)
    {
        return view('admin.travel-partners.edit', compact('partner'));
    }


    public function show(TravelPartner $partner)
{
    if (request()->ajax()) {
        return response()->json([
            'success' => true,
            'partner' => $partner
        ]);
    }

    return view('admin.travel-partners.show', compact('partner'));
}


public function update(Request $request, TravelPartner $partner)
{
    $validated = $request->validate([
        'company_name' => 'required|string|max:255',
        'api_type' => 'nullable|string|max:255',
        'commission_rate' => 'nullable|numeric|min:0|max:100',
        'partner_tier' => 'nullable|in:standard,premium,enterprise',
        'status' => 'required|in:active,pending,suspended',
        'contract_end_date' => 'nullable|date',
        'contact_email' => 'nullable|email|max:255',
        'contact_phone' => 'nullable|string|max:20',
        'contact_person' => 'nullable|string|max:255',
        'integration_date' => 'nullable|date',
        'monthly_revenue' => 'nullable|numeric|min:0',
        'api_credential_1' => 'nullable|string|max:500',
        'api_credential_2' => 'nullable|string|max:500',
        'api_credential_3' => 'nullable|string|max:500',
        'api_credential_4' => 'nullable|string|max:500',
        'api_credential_5' => 'nullable|string|max:500',
        'api_credential_6' => 'nullable|string|max:500',
        'development_mode' => 'nullable',
        'currency_support' => 'nullable|boolean',
        'payment_integration' => 'nullable|boolean',
        'custom_pnr_format' => 'nullable|boolean',
        'admin_notes' => 'nullable|string|max:1000',
        //'profile_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    $validated['development_mode'] = $request->has('development_mode') ? true : false;
    $validated['currency_support'] = $request->has('currency_support') ? true : false;
    $validated['payment_integration'] = $request->has('payment_integration') ? true : false;
    $validated['custom_pnr_format'] = $request->has('custom_pnr_format') ? true : false;
    $validated['updated_by'] = auth()->id();

    if (empty($validated['api_credential_2'])) unset($validated['api_credential_2']);
    if (empty($validated['api_credential_5'])) unset($validated['api_credential_5']);

    // Profile image upload to public folder
//    if ($request->hasFile('profile_image')) {
//        // Delete old image if exists
//        if ($partner->profile_image && file_exists(public_path('assets/images/' . $partner->profile_image))) {
//            unlink(public_path('assets/images/' . $partner->profile_image));
//        }
//
//        $file = $request->file('profile_image');
//        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
//
//        // Ensure directory exists
//        $destinationPath = public_path('assets/images/partners');
//        if (!file_exists($destinationPath)) {
//            mkdir($destinationPath, 0755, true);
//        }
//
//        // Move file to public directory
//        $file->move($destinationPath, $filename);
//
//        // Store relative path in database
//        $validated['profile_image'] = 'partners/' . $filename;
//    }

    try {
        $partner->update($validated);

        return redirect()->route('admin.travel-partners.index')
                         ->with('success', 'Travel partner updated successfully!');
    } catch (\Exception $e) {
        return redirect()->back()
                         ->withInput()
                         ->with('error', 'Error updating partner: ' . $e->getMessage());
    }
}

    public function destroy(TravelPartner $partner)
    {
        $partner->delete();

        return redirect()->route('admin.travel-partners.index')
                        ->with('success', 'Travel partner deleted successfully!');
    }
}

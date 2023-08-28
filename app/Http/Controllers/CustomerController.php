<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Http;
use Inertia\Response;

/**
 *
 * @extends Controller<Customer>
 */
class CustomerController extends Controller
{
    /**
     *
     *
     * @return Response
     */
    public function index()
    {
        $customers = Customer::paginate(10);
        return Inertia::render('Customer/Index', ['customers' => $customers]);
    }

    /**
     *
     * @return Response
     */
    public function create()
    {
        return Inertia::render('Customer/Create');
    }

    /**
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'phone_number' => 'required|string|regex:/^[0-9\-\+\(\) ]+$/',
            'email' => 'required|max:255',
            'desired_budget' => 'required|numeric|between:0,999999.99',
            'message' => 'required|string'
        ]);

        $customer = new Customer($request->input());
        $customer->save();

        return redirect()->route('customer.create');
    }

    /**
     * @param Customer $customer
     *
     * @return Response
     */
    public function show(Customer $customer)
    {
        return Inertia::render('Customer/Show', ['customer' => $customer]);
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function createUser(Request $request): JsonResponse {
        try {
            $request->validate([
                'customerId' => 'required|exists:App\Models\Customer,id',
            ]);

            $customerId = $request->customerId;
            $customer = Customer::find($customerId);

            $username = explode("@", $customer->email);

            $response = Http::withOptions([
                'verify' => false,
            ])
            ->withHeaders([
                'Content-Type'  => 'application/json',
                'Authorization' => 'Basic ' . base64_encode(env('WP_USERNAME') . ":" . env('WP_PASSWORD'))
            ])
            ->post(env('WP_URL').'/wp-json/wp/v2/users', [
                'username'      => $username[0],
                'first_name'    => $customer->name,
                'email'         => $customer->email,
                'password'      => $username[0],
                'meta'          => [
                    'from_laravel'  => true,
                    'laravel_id'    => $customer->id
                ]
            ]);

            if ($response->successful()) {
                return response()->json(['success' => true]);
            } else {
                $errorResponse = $response->json();
                return response()->json($errorResponse, 500);
            }
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();

            return response()->json($errorMessage, 500);
        }
    }
}

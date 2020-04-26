<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use PedroSancao\OTP\TOTP;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the user's codes.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Load user's codes.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function codes(Request $request)
    {
        $codes = $request->user()->accounts->map(function (Account $account) {
            $otp = TOTP::createRaw($account->secret);
            return [
                'name' => $account->name,
                'code' => $otp->getPassword(),
            ];
        });

        return response()->json($codes);
    }

    /**
     * Show new account form.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function add()
    {
        return view('add');
    }

    /**
     * Create new authenticator account.
     *
     * @param \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function new(Request $request)
    {
        $otp = TOTP::create($request->get('key'));
        $request->user()->accounts()->create([
            'name' => $request->get('name'),
            'secret' => $otp->getRawSecret(),
        ]);

        return redirect()->route('home')->with('status', __('Successfully added account.'));
    }

    /**
     * Manage user's accounts.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function manage(Request $request)
    {
        $accounts = $request->user()->accounts;

        return view('manage', compact('accounts'));
    }

    public function remove(Account $account)
    {
        $response = [
            'status' => $account->delete(),
        ];

        return response()->json($response);
    }
}

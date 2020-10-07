<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Display the specified resource.
     *
     * @return Factory|View
     */
    public function show()
    {
        $response = Session::get('user');

        return view('user.show_my_profile', ['user' => $response]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return Factory|View
     */
    public function edit()
    {
        $response = Session::get('user');

        return view('user.update_me', ['user' => $response]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Request $request)
    {
        $api = "user/update";

        $form = $request->all();

        $response = $this->postCurl($api, $form, 'PUT');

        if($response)
            return redirect()->route('home')->with('status', 'Your profile is updated!');
        else
            return redirect()->route('home')->with('error', 'I\'m so sorry, i don\'t know what happens. Try again later, please!');
    }
}

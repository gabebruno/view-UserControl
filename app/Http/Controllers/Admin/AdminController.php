<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function showAllUsers()
    {
        $api = 'user';

        $response = $this->getCurl($api);

        return view('admin/show_all_users', [
           'users' => $response
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $api = 'user/store';

        $form = $request->all();

        $response = $this->postCurl($api, $form, "POST");

        if ($response)
        {
            return redirect()->route('all_users')->with('status', 'Congrats! You created a new user.');
        }
        else
        {
            return redirect()->route('all_users')->with('error', 'Sorry, something happens and your request don\'t be done!');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $form = $request->all();

        if(isset($form['password']))
            bcrypt($form['password']);

        $api = 'user/update/'.$form['id'];
        
        $result = $this->postCurl($api, $form, 'PUT');

        if ($result) {
            return redirect()->route('all_users')->with('status', 'Yeh! User updated successfully!');
        }
        else
        {
            return redirect()->route('all_users')->with('error', 'Sorry, something happens and your request don\'t be done!');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $api = 'user/'.$id;

        $response = $this->getCurl($api);

        $response = $this->cleanData($response);

        return view('admin/update_user', [
            'user' => $response
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $api = 'user/delete/'.$id;

        if($this->postCurl($api, array(), 'DELETE'))
        {
            return redirect()->route('all_users')->with('status', 'The target has been destroyed!');
        }
        else
        {
            return redirect()->route('all_users')->with('error', "Sorry, something happens and your request don't be done!");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function showLogs()
    {
        $api = 'logs';
        $response = $this->getCurl($api);

        return view('admin/logs', ['logs' => $response]);
    }

}

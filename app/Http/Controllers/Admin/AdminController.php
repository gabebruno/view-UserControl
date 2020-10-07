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
        $api = 'http://usercontrolgabebruno.herokuapp.com/api/user';

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
        $api = 'https://usercontrolgabebruno.herokuapp.com/api/user/store';

        $form = $request->all();
//        $data = array(
//            'name' => $form['name'],
//            'address' => $form['address'],
//            'cpf' => $form['cpf'],
//            'email' => $form['email'],
//            'permission' => $form['permission'],
//            'phone' => $form['phone'],
//            'password' => bcrypt($form['password']),
//        );

        $data = $this->cleanData($form);

        $response = $this->postCurl($api, $data, "POST");

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

        $data = $this->cleanData($form);

        $api = 'https://usercontrolgabebruno.herokuapp.com/api/user/update/'.$data['id'];

        $result = $this->postCurl($api, $data, 'PUT');

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
        $api = 'http://usercontrolgabebruno.herokuapp.com/api/user/'.$id;

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
        $api = 'https://usercontrolgabebruno.herokuapp.com/api/user/delete/'.$id;

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
        $api = 'http://usercontrolgabebruno.herokuapp.com/api/logs';
        $response = $this->getCurl($api);

        return view('admin/logs', ['logs' => $response]);
    }

}

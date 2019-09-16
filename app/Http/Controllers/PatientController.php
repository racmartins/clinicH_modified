<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patients = User::patients()->paginate(5);
        return view('patients.index',compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('patients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|min:3',
            'email' => 'required|email',
            'identity_card' => 'nullable|digits:9',
            'address' => 'nullable|min:5',
            'phone' => 'nullable|min:9',
        ];
        $this->validate($request,$rules);

        //mass assignment
        User::create(
            $request->only('name','email','identity_card','address','phone')
            + [
                'role' =>'patient',
                'password' => bcrypt($request->input('password'))
            ]
        );
        $notification = 'O paciente registou-se corretamente.';
        return redirect('/patients')->with(compact('notification'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    public function edit(User $patient)
    {
        return view('patients.edit', compact('patient'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required|min:3',
            'email' => 'required|email',
            'identity_card' => 'nullable|digits:9',
            'address' => 'nullable|min:5',
            'phone' => 'nullable|min:9',
        ];
        $this->validate($request,$rules);

        $user = User::patients()->findOrFail($id);

        $data = $request->only('name','email','identity_card','address','phone');
        $password = $request->input('password');
        if($password)
            $data['password'] = bcrypt($password);
        $user->fill($data);
        $user->save(); //UPDATE

        $notification = 'A informação do paciente atualizou-se corretamente.';
        return redirect('/patients')->with(compact('notification'));
    }

    public function destroy(User $patient)
    {
        $patientName = $patient->name;
        $patient->delete();

        $notification = "O paciente $patientName foi corretamente eliminado.";
        return redirect('/patients')->with(compact('notification'));
    }
}

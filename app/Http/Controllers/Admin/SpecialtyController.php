<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Specialty;

use App\Http\Controllers\Controller;

class SpecialtyController extends Controller
{

    public function index()
    {
    	$specialties = Specialty::all();
    	return view('specialties.index',compact('specialties'));
    }
    public function create()
    {
    	return view('specialties.create');
    }
    private function performValidation(Request $request)
    {
    	$rules = [
    		'name' => 'required|min:3',
    		//'description' => 'required'
    	];

    	$messages = [
    			'name.required' => 'É necessário inserir um nome.',
    			'name.min' => 'É necessário inserir pelo menos 3 caracteres no campo nome.',
    	];

    	$this->validate($request,$rules,$messages);

    }
    public function store(Request $request)
    {
    	//dd($request->all());
    	$this->performValidation($request);

    	$specialty = new Specialty();
    	$specialty->name = $request->input('name');
    	$specialty->description = $request->input('description');
    	$specialty->save(); //INSERT

    	$notification ="A Especialidade registou-se corretamente";
    	return redirect('/specialties')->with(compact('notification'));
    }
    public function edit(Specialty $specialty)
    {
    	return view('specialties.edit',compact('specialty'));
    }
    public function update(Request $request, Specialty $specialty)
    {
    	//dd($request->all());
    	$this->performValidation($request);

    	$specialty->name = $request->input('name');
    	$specialty->description = $request->input('description');
    	$specialty->save(); //update

    	$notification = "A Especialidade foi corretamente atualizada";
    	return redirect('/specialties')->with(compact('notification'));
    }
    public function destroy(Specialty $specialty)
    {
    	$deletedSpecialty = $specialty->name;
    	$specialty->delete();

    	$notification = 'A Especialidade '.$deletedSpecialty.' foi corretamente eliminada';
    	return redirect('/specialties')->with(compact('notification'));
    }
}

<?php

public function store(){

    Project::create([
        'title' =>request('title'),
        'title' =>request('title'),
        'title' =>request('title'),
    ]);

    return redirect()->route('projects.index');
}

//segunda manera.

Project::create(request()->all());  //inserta todo

//OJO CON EL request no se necesita inyectarlo

//otra manera de insertar

Project::create(request()->only('title','name','ap'));  //inserta solo estos campos 
// el fillabel tendria que quedar 
protected $guarded= [];  Para poder hacer lo de arriba. 

//CON VALIDACIÓN

$clientes= request()->validate([
    'title' => 'required',
    'ap' => 'required',
    'am' => 'required',
]);

Clientes::create($clientes);

return redirect()->route('projects.index');

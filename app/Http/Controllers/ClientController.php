<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ClientController extends Controller
{
    use SoftDeletes;
    public function store(Request $request)
    {

        try {
            $data = $request->all();

            $request->validate([
                'name' => 'string|required|max:255',
                'cpf' => 'string|required|max:30',
                'email' => 'string|required|unique:clients,email',
                'date_birth' =>'|required|date',
                'adress'=> 'required|string'
            ]);

            Client::create($data);

            return $data;
        }catch(\Exception $exception){
            return $this->error($exception->getMessage(), Response::HTTP_BAD_REQUEST);
        }

    }

}

<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Traits\HttpResponses;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ClientController extends Controller
{    use HttpResponses;
    use SoftDeletes;
    public function store(Request $request)
    {

        try {
            $data = $request->all();

            $request->validate([
                'name' => 'string|required|max:255',
                'cpf' => 'string|required|unique:clients,cpf',
                'email' => 'string|required|unique:clients,email',
                'date_birth' =>'|required|date-format:Y-m-d',
                'address'=> 'required|string'
            ]);

            Client::create($data);

            return $data;
        }catch(\Exception $exception){
            return $this->error($exception->getMessage(), Response::HTTP_BAD_REQUEST);
        }

    }

}

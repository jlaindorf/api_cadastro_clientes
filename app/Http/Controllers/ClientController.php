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
        public function index(Request $request){


                $params = $request->query();


                $clients = Client::query();

                if($request->has('name') && !empty($params['name'])) {
                    $clients->where('name', 'ilike', "%".$params['name']."%");
                }

                if($request->has('cpf') && !empty($params['cpf'])) {
                    $clients->where('cpf', $params['cpf']);
                }

             if($request->has('date_birth') && !empty($params['date_birth'])) {
                $clients->where('date_birth', $params['date_birth']);
            }

            return $clients->get();
        }

        public function update($id, Request $request){
          try{  $data = $request->only('name', 'email', 'date_birth', 'address');
            $request->validate([
                'name' => 'string',
                'email' => 'string|unique:clients,email',
                'date_birth' =>'date-format:Y-m-d',
                'address'=> 'string'
            ]);



            $client = Client::find($id);
            if(!$client) return $this->error('Cliente não encontrado', Response::HTTP_NOT_FOUND);
            $client->update($data);
            return $client;
        }

        catch(\Exception $exception){
            return $this->error($exception->getMessage(), Response::HTTP_BAD_REQUEST);
        }


}
}

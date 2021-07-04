<?php

namespace App\Services;

use App\Models\Encurtador;
use Exception;
use Throwable;

const NUMERO_MAX_TENTATIVAS = 3;
class EncurtadorService {
    private $tentativas = 0;

    public function encurta($url)
    {

        try{
            $encurtador = Encurtador::create([
                'redirect' => $url,
                'code' => $this->geraHash()
            ]);
            return 'http://shortly.test/api/'.$encurtador->code;
        }catch(Throwable $e) {
            $this->tentativas++;
            if($this->tentativas == NUMERO_MAX_TENTATIVAS) {
                throw new Exception("Excedeu o numero de tentativas de criar, tente mais tarde ", $e->getCode());
            }
            $this->encurta($url);
        }


    }

    public function redireciona($document)
    {
        $url = Encurtador::whereCode($document)->first()->redirect;
        return $url;
    }

    public function geraHash(): string
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 7; $i++) {
            $randomString .= $characters[Rand(0, $charactersLength - 1)];
        }
        return $randomString;

    }
}

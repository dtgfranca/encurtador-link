<?php

namespace App\Http\Controllers;

use App\Services\EncurtadorService;
use Illuminate\Http\Request;

class EncurtadorController extends Controller
{
    public function encurta(Request $request, EncurtadorService $encurtadorService)
    {

        $this->validate($request, [
            'url' =>'required|url'
        ]);
        return $encurtadorService->encurta($request->get('url'));
    }
    public function redirect($document, EncurtadorService $encurtadorService)
    {
        $url = $encurtadorService->redireciona($document);
        return redirect()->to($url);
    }

}

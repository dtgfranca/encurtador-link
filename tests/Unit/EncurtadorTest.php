<?php

namespace Tests\Unit;

use App\Http\Controllers\EncurtadorController;
use App\Http\Requests\EncurtadorRequest;
use App\Services\EncurtadorService;
use Illuminate\Http\Request;
use Tests\TestCase;

class EncurtadorTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_encurta_url_ter_4_caracetres()
    {
        $link = "diegofranca.dev";
        $encurtador = new EncurtadorService();
        $reposta = $encurtador->encurta($link);
        dd($reposta);
        $this->assertEquals(7, strlen($reposta));
    }
}

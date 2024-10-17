<?php

namespace Tests\Unit\Prefeitura;

use App\Models\Prefeitura;
use App\UseCases\Prefeitura\CreatePrefeituraUseCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\CreatesApplication;
use Tests\TestCase;

class CreatePrefeituraTest extends TestCase
{
    use RefreshDatabase;
    use CreatesApplication;
    
    /**
     * A basic unit test example.
     */

    protected function setUp(): void
    {
        parent::setUp();
        // Se necessário, adicione outras configurações aqui
    }

    public function test_create_prefeitura(): void
    {
        $prefeitura = Prefeitura::factory()->make()->toArray();

        $useCase = new CreatePrefeituraUseCase();
        $newPrefeitura = $useCase->execute($prefeitura);

        $this->assertInstanceOf(Prefeitura::class, $newPrefeitura);
        $this->assertEquals($prefeitura['name'], $newPrefeitura->name);
        $this->assertEquals($prefeitura['cnpj'], $newPrefeitura->cnpj);
        $this->assertEquals($prefeitura['city'], $newPrefeitura->city);
        $this->assertEquals($prefeitura['mayor'], $newPrefeitura->mayor);
        $this->assertEquals($prefeitura['email'], $newPrefeitura->email);
    }
}

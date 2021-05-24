<?php
declare(strict_types=1);

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;

/**
 * Comum component
 */
class ComumComponent extends Component
{
    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    public function validaCPF($cpf) {
        // Extrai somente os números
        $cpf = preg_replace( '/[^0-9]/is', '', $cpf );
         
        // Verifica se foi informado todos os digitos corretamente
        if (strlen($cpf) != 11) {
            return false;
        }
    
        // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }
    
        // Faz o calculo para validar o CPF
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }
        return true;
    }

    public function removeCaractere($cpf){
        $cpf_sem_caractere = str_replace('-', '', str_replace('.', '', $cpf));

        return $cpf_sem_caractere;
    }

    public function valida_email($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public function formataCPF($cpf)
    {
        $cpf1 = substr($cpf, 0, 3);
        $cpf2 = substr($cpf, 3, 3);
        $cpf3 = substr($cpf, 6, 3);
        $cpf4 = substr($cpf, 9, 2);

        return $cpf1 . '.' . $cpf2 . '.' . $cpf3 . '-' .$cpf4;
    }
}

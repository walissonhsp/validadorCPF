class Documento{

        /**
         * @param $numero, recebe o número do CPF para validação. 
         */
        public function setCpf($numero){

            $resultado = Documento::validaCpf($numero);

            if($resultado === false){

                throw new Exception("CPF informado não é válido.", 1);

            }

        }

        /**
         * Verifica a existencia do CPF
         * @param $recebeCpf recebe o número
         */
        public function validaCpf($recebeCpf)::bool{
            /* Verifica se o número foi informado */
            if(empty($recebeCpf)) return false;

            /* Elimina possíveis mascaras */
            $recebeCpf = preg_replace('[^0-9]', '', $recebeCpf);
            $recebeCpf = str_pad($recebeCpf, 11, '0', STR_PAD_LEFT);

            /* Verifica se o número de digitos informado é igual a 11 */
            if(strlen($recebeCpf) != 11):
                return false;
            
            /**
             * Verifica se nenhuma das sequencias abaixo, foram digitadas.
             * Caso foi digitada, ele retorna false.
             */
            elseif($recebeCpf == "00000000000" || $recebeCpf == "11111111111" || $recebeCpf == "22222222222" || $recebeCpf == "33333333333" || $recebeCpf == "44444444444" || $recebeCpf == "55555555555" || $recebeCpf == "66666666666" || $recebeCpf == "77777777777" || $recebeCpf == "88888888888" || $recebeCpf == "99999999999"):

                return false;

            else:

                /**
                 * Calcula os digitos do CPF para verificar se ele é válido.
                 */
                for ($dig = 9; $dig < 11; $dig++) {
             
                    for ($d = 0, $c = 0; $c < $dig; $c++) {
                        $d += $cpf{$c} * (($t + 1) - $c);
                    }

                    $d = ((10 * $d) % 11) % 10;

                    if ($cpf{$c} != $d) {
                        return false;
                    }
                }

                return true;

            endif;            
        }

}

<?php

namespace App\Interfaces;

interface ConfiguracionAlertaInterface extends BaseInterface
{
    public function getByDiasAnticipacionEntrega(int $dias);

    public function getUltimaConfiguracion();
}

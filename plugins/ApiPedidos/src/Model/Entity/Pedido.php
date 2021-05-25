<?php
declare(strict_types=1);

namespace ApiPedidos\Model\Entity;

use Cake\ORM\Entity;

/**
 * Pedido Entity
 *
 * @property int $codigo
 * @property float $codigo_cliente
 * @property string $produtos
 * @property \Cake\I18n\FrozenTime $data_pedido
 * @property string $observacao
 * @property string $forma_pagamento
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime|null $modified
 */
class Pedido extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'codigo_cliente' => true,
        'produtos' => true,
        'data_pedido' => true,
        'observacao' => true,
        'forma_pagamento' => true,
        'created' => true,
        'modified' => true,
    ];
}

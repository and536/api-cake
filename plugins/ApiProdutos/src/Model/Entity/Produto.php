<?php
declare(strict_types=1);

namespace ApiProdutos\Model\Entity;

use Cake\ORM\Entity;

/**
 * Produto Entity
 *
 * @property int $codigo
 * @property string $nome
 * @property string $cor
 * @property string $tamanho
 * @property float $valor
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime|null $modified
 */
class Produto extends Entity
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
        'nome' => true,
        'cor' => true,
        'tamanho' => true,
        'valor' => true,
        'created' => true,
        'modified' => true,
    ];
}

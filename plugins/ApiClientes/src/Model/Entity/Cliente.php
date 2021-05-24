<?php
declare(strict_types=1);

namespace ApiClientes\Model\Entity;

use Cake\ORM\Entity;

/**
 * Cliente Entity
 *
 * @property int $codigo
 * @property string $cpf
 * @property string $nome
 * @property string $sexo
 * @property string $email
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime|null $modified
 */
class Cliente extends Entity
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
        'cpf' => true,
        'nome' => true,
        'sexo' => true,
        'email' => true,
        'created' => true,
        'modified' => true,
    ];
}

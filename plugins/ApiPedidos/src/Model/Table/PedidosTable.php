<?php
declare(strict_types=1);

namespace ApiPedidos\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Pedidos Model
 *
 * @method \ApiPedidos\Model\Entity\Pedido newEmptyEntity()
 * @method \ApiPedidos\Model\Entity\Pedido newEntity(array $data, array $options = [])
 * @method \ApiPedidos\Model\Entity\Pedido[] newEntities(array $data, array $options = [])
 * @method \ApiPedidos\Model\Entity\Pedido get($primaryKey, $options = [])
 * @method \ApiPedidos\Model\Entity\Pedido findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \ApiPedidos\Model\Entity\Pedido patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \ApiPedidos\Model\Entity\Pedido[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \ApiPedidos\Model\Entity\Pedido|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \ApiPedidos\Model\Entity\Pedido saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \ApiPedidos\Model\Entity\Pedido[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \ApiPedidos\Model\Entity\Pedido[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \ApiPedidos\Model\Entity\Pedido[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \ApiPedidos\Model\Entity\Pedido[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PedidosTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('pedidos');
        $this->setDisplayField('codigo');
        $this->setPrimaryKey('codigo');

        $this->addBehavior('Timestamp');
        $this->addBehavior('CheckTest');

        $this->belongsTo('ApiClientes.Clientes')
            ->setForeignKey(false)
            ->setConditions(['Pedidos.codigo_cliente = Clientes.codigo']);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->allowEmptyString('codigo', null, 'create');

        $validator
            ->numeric('codigo_cliente')
            ->requirePresence('codigo_cliente', 'create')
            ->notEmptyString('codigo_cliente');

        $validator
            ->scalar('produtos')
            ->requirePresence('produtos', 'create')
            ->notEmptyString('produtos');

        $validator
            ->dateTime('data_pedido')
            ->notEmptyDateTime('data_pedido');

        $validator
            ->scalar('observacao')
            ->maxLength('observacao', 1000)
            ->requirePresence('observacao', 'create')
            ->notEmptyString('observacao');

        $validator
            ->scalar('forma_pagamento')
            ->maxLength('forma_pagamento', 255)
            ->requirePresence('forma_pagamento', 'create')
            ->notEmptyString('forma_pagamento');

        return $validator;
    }
}

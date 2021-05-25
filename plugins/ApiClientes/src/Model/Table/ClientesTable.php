<?php
declare(strict_types=1);

namespace ApiClientes\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Clientes Model
 *
 * @method \ApiClientes\Model\Entity\Cliente newEmptyEntity()
 * @method \ApiClientes\Model\Entity\Cliente newEntity(array $data, array $options = [])
 * @method \ApiClientes\Model\Entity\Cliente[] newEntities(array $data, array $options = [])
 * @method \ApiClientes\Model\Entity\Cliente get($primaryKey, $options = [])
 * @method \ApiClientes\Model\Entity\Cliente findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \ApiClientes\Model\Entity\Cliente patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \ApiClientes\Model\Entity\Cliente[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \ApiClientes\Model\Entity\Cliente|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \ApiClientes\Model\Entity\Cliente saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \ApiClientes\Model\Entity\Cliente[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \ApiClientes\Model\Entity\Cliente[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \ApiClientes\Model\Entity\Cliente[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \ApiClientes\Model\Entity\Cliente[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ClientesTable extends Table
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

        $this->setTable('clientes');
        $this->setDisplayField('codigo');
        $this->setPrimaryKey('codigo');

        $this->addBehavior('Timestamp');
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
            ->scalar('cpf')
            ->maxLength('cpf', 255)
            ->requirePresence('cpf', 'create')
            ->notEmptyString('cpf')
            ->add('cpf', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('nome')
            ->maxLength('nome', 255)
            ->requirePresence('nome', 'create')
            ->notEmptyString('nome');

        $validator
            ->scalar('sexo')
            ->maxLength('sexo', 255)
            ->requirePresence('sexo', 'create')
            ->notEmptyString('sexo');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmptyString('email');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->isUnique(['cpf']), ['errorField' => 'cpf']);

        return $rules;
    }
}

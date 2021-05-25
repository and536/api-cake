<?php
declare(strict_types=1);

namespace ApiProdutos\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Produtos Model
 *
 * @method \ApiProdutos\Model\Entity\Produto newEmptyEntity()
 * @method \ApiProdutos\Model\Entity\Produto newEntity(array $data, array $options = [])
 * @method \ApiProdutos\Model\Entity\Produto[] newEntities(array $data, array $options = [])
 * @method \ApiProdutos\Model\Entity\Produto get($primaryKey, $options = [])
 * @method \ApiProdutos\Model\Entity\Produto findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \ApiProdutos\Model\Entity\Produto patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \ApiProdutos\Model\Entity\Produto[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \ApiProdutos\Model\Entity\Produto|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \ApiProdutos\Model\Entity\Produto saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \ApiProdutos\Model\Entity\Produto[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \ApiProdutos\Model\Entity\Produto[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \ApiProdutos\Model\Entity\Produto[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \ApiProdutos\Model\Entity\Produto[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ProdutosTable extends Table
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

        $this->setTable('produtos');
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
            ->scalar('nome')
            ->maxLength('nome', 255)
            ->requirePresence('nome', 'create')
            ->notEmptyString('nome');

        $validator
            ->scalar('cor')
            ->maxLength('cor', 255)
            ->requirePresence('cor', 'create')
            ->notEmptyString('cor');

        $validator
            ->scalar('tamanho')
            ->maxLength('tamanho', 255)
            ->requirePresence('tamanho', 'create')
            ->notEmptyString('tamanho');

        $validator
            ->numeric('valor')
            ->requirePresence('valor', 'create')
            ->notEmptyString('valor');

        return $validator;
    }
}

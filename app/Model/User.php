<?php
App::uses('AppModel', 'Model');
/**
 * User Model
 *
 * @property PermissionGroup $PErmissionGroup
 * @property Post $Post
 */
class User extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'username' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'password' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'permission_group_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'PermissionGroup' => array(
			'className' => 'PermissionGroup',
			'foreignKey' => 'permission_group_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

    public $actsAs = array('Acl' => array('type' => 'requester', 'enabled' => false));

    public function beforeSave($options = array()) {
        $this->data['User']['password'] = AuthComponent::password(
            $this->data['User']['password']
        );
        return true;
    }

    public function parentNode() {
        if (!$this->id && empty($this->data)) {
            return null;
        }
        if (isset($this->data['User']['permission_group_id'])) {
            $groupId = $this->data['User']['permission_group_id'];
        } else {
            $groupId = $this->field('permission_group_id');
        }
        if (!$groupId) {
            return null;
        } else {
            return array('PermissionGroup' => array('id' => $groupId));
        }
    }

    public function bindNode($user) {
        return array('model' => 'PermissionGroup', 'foreign_key' => $user['User']['permission_group_id']);
    }
}

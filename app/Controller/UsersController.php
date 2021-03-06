<?php
App::uses('AppController', 'Controller');

/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController
{

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator');

    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow('login', 'initDb');
    }

    /**
     * index method
     *
     * @return void
     */
    public function index()
    {
        $this->User->recursive = 0;
        $this->set('users', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null)
    {
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }
        $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
        $this->set('user', $this->User->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
            }
        }
        $groups = $this->User->PermissionGroup->find('list');
        $this->set(compact('groups'));
    }

    /**
     * add student method
     *
     * @return void
     */
    public function add_student() {
        if ($this->request->is('post')) {
            $this->loadModel('PermissionGroup');
            $this->PermissionGroup->unbindModel(array('hasMany' => 'User'));

            // Set user group to 'students'
            $groupId = $this->PermissionGroup->findByName('Students')['PermissionGroup']['id'];
            $this->request->data['User']['permission_group_id'] = $groupId;

            // Save student
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
            }
        }
    }

    /**
     * add student method
     *
     * @return void
     */
    public function add_teacher() {
        if ($this->request->is('post')) {
            $this->loadModel('PermissionGroup');
            $this->PermissionGroup->unbindModel(array('hasMany' => 'User'));

            // Set user group to 'students'
            $groupId = $this->PermissionGroup->findByName('Teachers')['PermissionGroup']['id'];
            $this->request->data['User']['permission_group_id'] = $groupId;

            // Save student
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
            }
        }
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null)
    {
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
            $this->request->data = $this->User->find('first', $options);
        }
        $groups = $this->User->PermissionGroup->find('list');
        $this->set(compact('groups'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null)
    {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->User->delete()) {
            $this->Session->setFlash(__('The user has been deleted.'));
        } else {
            $this->Session->setFlash(__('The user could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    /**
     * Login user
     */
    public function login()
    {
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {

                // Redirect to user panel
                $loginData = $this->Auth->user();
                if ($loginData['PermissionGroup']['name'] == 'Students') {
                    $this->Auth->loginRedirect = array(
                        'controller' => 'users',
                        'action' => 'students'
                    );
                    $this->Session->write('user_role', 'student');
                }
                else if ($loginData['PermissionGroup']['name'] == 'Teachers') {
                    $this->Auth->loginRedirect = array(
                        'controller' => 'users',
                        'action' => 'teachers'
                    );
                    $this->Session->write('user_role', 'teacher');
                }
                else if ($loginData['PermissionGroup']['name'] == 'Admins') {
                    $this->Auth->loginRedirect = array(
                        'controller' => 'users',
                        'action' => 'admins'
                    );
                    $this->Session->write('user_role', 'admin');
                }
                return $this->redirect($this->Auth->redirect());
            }
            $this->Session->setFlash(__('Your username or password was incorrect.'));
        }
    }

    /**
     * Log user out
     */
    public function logout()
    {
        $this->Session->setFlash('Good-Bye');
        $this->redirect($this->Auth->logout());
    }

    /**
     * Insert permissions into db
     * Delete before deployment
     */
    public function initDB()
    {
        $group = $this->User->PermissionGroup;

        // Admins
        $group->id = 1;
        $this->Acl->allow($group, 'controllers');

        // Teachers
        $group->id = 2;
        $this->Acl->deny($group, 'controllers');
        $this->Acl->allow($group, 'controllers/users/logout');
        $this->Acl->allow($group, 'controllers/users/teachers');

        $this->Acl->allow($group, 'controllers/groups/index');
        $this->Acl->allow($group, 'controllers/groups/view');
        $this->Acl->allow($group, 'controllers/groups/add');
        $this->Acl->allow($group, 'controllers/groups/edit');
        $this->Acl->allow($group, 'controllers/groups/delete');

        $this->Acl->allow($group, 'controllers/pages/display');

        // Students
        $group->id = 3;
        $this->Acl->deny($group, 'controllers');
        $this->Acl->allow($group, 'controllers/users/logout');
        $this->Acl->allow($group, 'controllers/users/students');

        $this->Acl->allow($group, 'controllers/pages/display/manual');

        // we add an exit to avoid an ugly "missing views" error message
        echo "all done";
        exit;
    }

    public function teachers() {

    }

    public function students() {
        $panelHeader = 'student';

        $loggedUser = $this->Auth->user();
        $username = $loggedUser['username'];

        $this->set(compact('panelHeader', 'username'));

    }

    public function admins() {

    }
}

<?php
namespace App\Controllers;
use Core\Controller;
use Core\Session;
use Core\Router;
use App\Models\Contacts;
use App\Models\Users;

/**
 * Implements support for our Contact Controller.  It contains actions for 
 * handling user interactions that will result in CRUD operations against the 
 * database.
 */
class ContactsController extends Controller {
    /**
     * Constructor for the ContactsController.  It sets the default layout 
     * and loads the Contacts model.
     *
     * @param string $controller The name of the controller obtained while 
     * parsing the URL.
     * @param string $action The name of the action specified in the path of 
     * the URL.
     */
    public function __construct($controller, $action) {
        parent::__construct($controller, $action);
        $this->view->setLayout('default');
        $this->load_model('Contacts');
    }

    public function addAction() {
        $contact = new Contacts();
        if($this->request->isPost()) {
            $this->request->csrfCheck();
            $contact->assign($this->request->get());
            $contact->user_id = Users::currentUser()->id;
            if($contact->save()) {
                Router::redirect('contacts');
            }
        }

        $this->view->contact = $contact;
        $this->view->displayErrors = $contact->getErrorMessages();
        // Set action for post.
        $this->view->postAction = PROOT . 'contacts' . DS . 'add';
        $this->view->render('contacts/add');
    }


    public function deleteAction($id) {
        $contact = $this->ContactsModel->findByIdAndUserId((int)$id, Users::currentUser()->id);
        if($contact) {
            $contact->delete();
            Session::addMessage('success', 'Contact has been deleted');
        }
        Router::redirect('contacts');
    }
    
    public function detailsAction($id) {
        $contact = $this->ContactsModel->findByIdAndUserId((int)$id, Users::currentUser()->id);

        // When user is not a contact we reroute to contacts index.
        if(!$contact) {
            Router::redirect('contacts');
        }

        $this->view->contact = $contact;
        $this->view->render('contacts/details');
    }

    public function editAction($id) {
        $contact = $this->ContactsModel->findByIdAndUserId((int)$id, Users::currentUser()->id);

        // Check if contact exists
        if(!$contact) Router::redirect('contacts');
        if($this->request->isPost()) {
            $this->request->csrfCheck();
            $contact->assign($this->request->get());
            if($contact->save()) {
                Router::redirect('contacts');
            }
        }
        $this->view->displayErrors = $contact->getErrorMessages();
        $this->view->contact = $contact;
        $this->view->postAction = PROOT . 'contacts' . DS . 'edit' . DS . $contact->id;
        $this->view->render('contacts/edit');
    }

    /**
     * The index action loads the home page for contacts that lists all 
     * contacts associated with a particular user.
     *
     * @return void
     */
    public function indexAction() {
        $contacts = $this->ContactsModel->findAllByUserId(Users::currentUser()->id, ['order'=>'lname, fname']);
        $this->view->contacts = $contacts;
        $this->view->render('contacts/index');
    }
}
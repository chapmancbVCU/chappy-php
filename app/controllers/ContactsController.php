<?php
namespace App\Controllers;
use Core\Controller;
use Core\Session;
use Core\Router;
use App\Models\Contacts;
use App\Models\Users;
use Core\Helper;
/**
 * Implements support for our Contacts Controller.  It contains actions for 
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
    // public function __construct(string $controller, string $action) {
    //     parent::__construct($controller, $action);
    //     $this->view->setLayout('default');
    //     $this->load_model('Contacts');
    // }

    public function onConstruct(){
        $this->view->setLayout('default');
        $this->currentUser = Users::currentUser();
    }

    /**
     * Displays view for adding a new contact, assists with form validation, 
     * and begins task for saving record to database.
     *
     * @return void
     */
    public function addAction(): void {
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

    /**
     * Performs delete operation on a contact and redirects user back to the 
     * index contacts view.
     *
     * @param int $id The ID of the contact to be deleted.
     * @return void
     */
    public function deleteAction(int $id): void {
        $contact = $this->ContactsModel->findByIdAndUserId((int)$id, Users::currentUser()->id);
        if($contact) {
            $contact->delete();
            Session::addMessage('success', 'Contact has been deleted');
        }
        Router::redirect('contacts');
    }
    
    /**
     * Retrieves information for a contact and render its details.
     *
     * @param mixed $id The id for contact whose information we want to display.
     * @return void
     */
    public function detailsAction(mixed $id): void {
        $contact = $this->ContactsModel->findByIdAndUserId((int)$id, Users::currentUser()->id);

        // When user is not a contact we reroute to contacts index.
        if(!$contact) {
            Router::redirect('contacts');
        }

        $this->view->contact = $contact;
        $this->view->render('contacts/details');
    }

    /**
     * Retrieves contact by ID and sets up view for editing a contact.  If 
     * form validation fails the page is displayed again with the appropriate 
     * messages.  If the contact does not exist the user is redirected to 
     * the main contacts page.
     *
     * @param int $id The ID for the contact whose information we want too 
     * edit.
     * @return void
     */
    public function editAction(int $id): void {
        $contact = $this->ContactsModel->findByIdAndUserId((int)$id, Users::currentUser()->id);

        // Check if contact exists
        if(!$contact) Router::redirect('contacts');
        if($this->request->isPost()) {
            $this->request->csrfCheck();
            $contact->assign($this->request->get(), Contacts::blackList);
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
    public function indexAction(): void {
        //Helper::dnd($this->currentUser);
        $contacts = Contacts::findAllByUserId($this->currentUser->id, ['order'=>'lname, fname']);
        $this->view->contacts = $contacts;
        $this->view->render('contacts/index');
    }
}
<?php $this->setSiteTitle("Controllers - User Guide"); ?>
<?php $this->start('body'); ?>

<div class="main">
    <div class="position-fixed">
        <a href="<?=APP_DOMAIN?>userguide/index" class="btn btn-xs btn-secondary">User Guide Home</a>
    </div>
    <h1 class="text-center">Controllers</h1>
    <div class="mb-5 mt-3 w-75 bg-light mx-auto border rounded p-4">
        <ol class="pl-4">
            <li><a href="#overview">Overview</a></li>
            <li><a href="#controller-file">Controller File</a></li>
            <li><a href="#example">Example</a></li>
        </ol>
    </div>

    <h1 id="overview" class="text-center">Overview</h1>
    <div class="mb-5 mt-3 w-75 bg-light mx-auto border rounded p-4">
        <p>This framework supports controllers to manage the interactions between views 
            and models.
        </p>
    </div>

    <h1 id="controller-file" class="text-center">Controller File</h1>
    <div class="mb-5 mt-3 w-75 bg-light mx-auto border rounded p-4">
        <p>Let's begin by creating a new controller using all available 
            options and arguments: 
        </p>
<pre class="mb-1 pb-1">
<code class="language-php line-numbers">php console make:controller Foo --layout=admin --resource
</code>
</pre>  
        <p>The first argument is the name and the first letter should always be upper case.  It is
            used to create the name of the controller class.  The --layout option is optional.  If 
            you do not use this option the layout is set to default.  Finally, the --resource 
            option creates boilerplate functions that you can use.  The file created by running this 
            command is shown below:
        </p>
<pre class="mb-1 pb-1">
<code class="language-php line-numbers">namespace App\Controllers;
use Core\Controller;

/**
 * Undocumented class
 */
class FooController extends Controller {
    /**
     * Runs when the object is constructed.
     *
     * @return void
     */
    public function onConstruct(): void{
        $this->view->setLayout('admin');
    }

    public function indexAction(): void {
        //
    }
    
    public function addAction(): void {
        //
    }

    public function deleteAction(): void {
        //
    }

    public function editAction(): void {
        //
    }

    public function updateAction(): void {
        //
    }
}
</code>
</pre>
    <p>The first function you see is the onConstruct.  Any default settings you 
        need for the controller is set here.  It called by the Controller parent 
        class' constructor.  The value for the --layout option is used to 
        set the layout in this function.
    </p>
    <p>All of the other functions supports the default index action and the Create,
        Read, Update, and Delete (CRUD) operations.  With this framework we require that 
        functions that represent actions end with the word <q>Action</q>.  Otherwise, 
        the route function is unable to work correctly.
    </p>
    </div>

    <h1 id="example" class="text-center">Example</h1>
    <div class="mb-5 mt-3 w-75 bg-light mx-auto border rounded p-4">
        <p>We will be using a controller from an example contact management 
            system to tie how models, views, and controllers work together.  Let's begin 
            with the Create operation as shown below:
        </p>

<pre class="mb-1 pb-1">
<code class="language-php line-numbers">public function addAction(): void {
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
    $this->view->postAction = APP_DOMAIN . 'contacts' . DS . 'add';
    $this->view->render('contacts/add');
}
</code>
</pre>
        <p>With this framework we standardize Create operations using a function 
            called addAction.  You can call it what ever you want as long 
            as the function's name ends with <q>Action</q>.
        </p>

        <p>We first begin with creating a new $contact object and we test if 
            the request is a post.  If a form has been rendered for the first time 
            this block is skipped and the $view object is configured so that data 
            is displayed correctly.  Within this if statement we perform a Cross 
            Site Request Forgery check and get data from the post request.  
        </p>

        <p>A quick note on configuring views by looking at line 12.  You can think of 
            this statement as being something familiar to passing props to blade.php 
            views in Laravel.  Within the view you don't have to use a @props directive.  You, 
            just have to use it.  More on this in the views section of the user guide.
        </p>

        <p>Finally, we save the data to the database and redirect the user.  Note that 
            the redirect has one word but render has  'contacts/add'.  If you just enter 
            contacts the controller assumes that the index action is wanted.  'contact' is 
            also the name of the directory for all of the contact related views.  The structure 
            is setup as follows:
        </p>

<pre class="mb-1 pb-1">
<code class="language-php line-numbers">$this->view->render('model_name/action_name');
</code>
</pre> 

        <p>The URL path equivalent you will see in the address bar is as follows:</p>
<pre class="mb-1 pb-1">
<code class="language-php line-numbers">http://hostname/model_name/action_name
</code>
</pre> 

        <p>This controller has a couple of ways to perform the Read operation from the 
            CRUD paradigm.  We perform reads in the indexAction and detailsAction.  Let's 
            go over the detailsAction function first.
        </p>

<pre class="mb-1 pb-1">
<code class="language-php line-numbers">public function detailsAction(int $id): void {
    $contact = Contacts::findByIdAndUserId((int)$id, Users::currentUser()->id);

    // When user is not a contact we reroute to contacts index.
    if(!$contact) {
        Router::redirect('contacts');
    }

    $this->view->contact = $contact;
    $this->view->render('contacts/details');
}
</code>
</pre> 

        <p>For this action we are interested in displaying information for a particular 
            contact.  Note that this function has a parameter name id of type int.  This 
            function obtains this parameter from the URL path as shown below:
        </p>

<pre class="mb-1 pb-1">
<code class="language-php line-numbers">http://hostname/contacts/details/1
</code>
</pre> 

        <p>Parsing out this path we see the expected identifier for contacts and the 
            action name of details.  The third part is interpreted as a parameter.  In 
            this case it is the <q>id</q> for the contact whose details we want to display.  Next, 
            we use the contact's model to obtain the record.  This function on line 2 requires 
            the id we initially passed along with the id of the current user.
        </p>

        <p>Then we determine if the contact exists.  If not, we redirect to the contacts view.  Finally,
            we configure the view and render the selected contact's details.  The indexAction 
            is much simpler as shown below.
        </p>

<pre class="mb-1 pb-1">
<code class="language-php line-numbers">public function indexAction(): void {
    $contacts = Contacts::findAllByUserId($this->currentUser->id, ['order'=>'lname, fname']);
    $this->view->contacts = $contacts;
    $this->view->render('contacts/index');
}
</code>
</pre> 
        <p>Nothing too complicated here but line 2 is noteworthy.  Notice the second parameter 
            in the findAllByUserId.  We cover this more details in the model section but note we 
            are using an associative array with a key of order and values 'lname, fname'.  This, 
            framework supports setting parameters to configure query operations.  In this example, 
            we want to older our results by last name and then by first name.
        </p>

        <p>Update operations is similar to the Create operation.  There are some noteworthy 
            differences to discuss so we have the code for the ContactsController's editAction 
            shown below.
        </p>

<pre class="mb-1 pb-1">
<code class="language-php line-numbers">public function editAction($id) {
    $contact = Contacts::findByIdAndUserId((int)$id, Users::currentUser()->id);

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
    $this->view->postAction = APP_DOMAIN . 'contacts' . DS . 'edit' . DS . $contact->id;
    $this->view->render('contacts/edit');
}
</code>
</pre>

        <p>The first step is to get the contact record and make sure it's associated with the 
            current user.  The other difference is in the assign function on line 8.  Notice 
            the second parameter <q>Contacts::blackList</q>.  This is an array that is found 
            in the Contact's model and is used to protect certain database fields from being 
            inadvertently updated.
        </p>

        <p>The Delete operation is also very simple.  In the example below you will find 
            the findByIdAndUserId function again along with the setup of the confirmation 
            Session Message.  More about Session Messages can be found 
            <a href="<?=APP_DOMAIN?>userguide/sessionMessages">here</a>.
        </p>

<pre class="mb-1 pb-1">
<code class="language-php line-numbers">public function deleteAction(int $id): void {
    $contact = Contacts::findByIdAndUserId((int)$id, Users::currentUser()->id);
    if($contact) {
        $contact->delete();
        Session::addMessage('success', 'Contact has been deleted');
    }
    Router::redirect('contacts');
}
</code>
    </div>
</div>
<?php $this->end(); ?>
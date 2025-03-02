<h1 style="font-size: 50px; text-align: center;">Pagination</h1>

## Table of contents
1. [Overview](#overview)
2. [Setup](#controller)

## Overview <a id="overview"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
Pagination is supported with the use of a Pagination class and built in Bootstrap 5 support.  An example of this is shown below in Figure 1.

<div style="text-align: center;">
  <img src="assets/seeded-contacts.png" alt="Pagination example">
  <p style="font-style: italic;">Figure 1 - Pagination example</p>
</div>

## Setup <a id="setup"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
The following are instructions for setting up Pagination within your controller.  We will use the `indexAction` of the `ContactsController`.

1. Import Pagination class:

```php
use Core\Lib\Pagination;
``

2. Get current page:
```php
$page = Pagination::currentPage($this->request);
```

3. Get total records, in this case the number of contacts for this user when creating instance of Pagination class.  The condition is the `user_id` and we bind with the current user's id since we want only contacts associated with this user.

```php
$pagination = new Pagination($page, 10, Contacts::findTotal([
    'conditions' => 'user_id = ?',
    'bind'       => [$this->currentUser->id]
]));
```

4. Retrieve paginated records using base model's find method.  In this step we use the paginationParams function from the Pagination class to build our query:

```php
$contacts = Contacts::find($pagination->paginationParams(
    'user_id = ?',                  // Conditions
    [$this->currentUser->id],       // Bind
    'lname, fname')                 // Order
);
```

5. Configure the view:

```php
$this->view->pagination = Pagination::pagination($page, $pagination->totalPages());
```

Putting everything together here is the complete indexAction function:

```php
public function indexAction(): void {
    // Determine current page
    $page = Pagination::currentPage($this->request);

    // Get the total number of contacts for the user
    $pagination = new Pagination($page, 10, Contacts::findTotal([
        'conditions' => 'user_id = ?',
        'bind'       => [$this->currentUser->id]
    ]));
    
    // Retrieve paginated contacts using the base model’s find method
    $contacts = Contacts::find($pagination->paginationParams(
        'user_id = ?', 
        [$this->currentUser->id], 
        'lname, fname')
    );

    // Configure the view
    $this->view->contacts = $contacts;
    $this->view->pagination = Pagination::pagination($page, $pagination->totalPages());
    $this->view->render('contacts/index');
}
```

6. Within your view add the following line, in this cases, right after the closing tag for the table element:

```php
<?= $this->pagination ?>
```
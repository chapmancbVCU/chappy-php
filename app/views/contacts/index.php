<?php $this->start('body'); ?>
<h2 class="text-center">My Contacts</h2>
<table class="table table-striped table-condensed table-bordered table-hover">
    <thead>
        <th>Name</th>
        <th>Email</th>
        <th>Cell Phone</th>
        <th>Home Phone</th>
        <th>Work Phone</th>
        <th></th>
    </thead>
    <tbody>
        <?php foreach($this->contacts as $contact): ?>
            <tr>
                <td>
                    <a href="<?=PROOT?>contacts/details/<?=$contact->id?>">
                        <?= $contact->displayName(); ?>
                    </a>
                </td>
                <td><?= $contact->email ?></td>
                <td><?= $contact->cell_phone ?></td>
                <td><?= $contact->home_phone ?></td>
                <td><?= $contact->work_phone ?></td>
                <td class="text-center">
                    <a href="<?=PROOT?>contacts/edit/<?=$contact->id?>" class="btn btn-info btn-xs">
                        <i class="fa fa-edit"></i> Edit
                    </a>
                    <a href="<?=PROOT?>contacts/delete/<?=$contact->id?>" class="btn btn-danger btn-xs" onclick="if(!confirm('Are your sure?')){return false;}">
                        <i class="fa fa-trash"></i> Delete
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php $this->end(); ?>
<?php echo $this->getContent(); ?>

<p>
	<h1>Hi, <?php echo $user->name; ?></h1>
    <h2>Your Invoices</h2>
</p>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Description</th>
            <th>Added on</th>
            <th>Status</th>
            <th>Finish</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($tasks as $task) { ?>
        <tr>
            <td><?php echo $task->id; ?></td>
            <td><?php echo $task->title; ?></td>
            <td><?php echo $task->description; ?></td>
            <td><?php echo $task->date_added; ?></td>
            <td><span class="label label-success">Success</span></td>
            <td>Check</td>
        </tr>
        <?php } ?>
    </tbody>
</table>
<br/><br/>
<p>
	<?php echo Phalcon\Tag::linkTo(array('session/end', 'Log out', 'class' => 'btn btn-primary btn-large btn-success')); ?>
</p>
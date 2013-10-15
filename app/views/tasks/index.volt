{{ content() }}

<p>
	<h1>Hi, {{ user.name }}</h1>
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
        {% for task in tasks %}
        <tr>
            <td>{{ task.id }}</td>
            <td>{{ task.title }}</td>
            <td>{{ task.description }}</td>
            <td>{{ task.date_added }}</td>
            <td><span class="label label-success">Success</span></td>
            <td>Check</td>
        </tr>
        {% endfor %}
    </tbody>
</table>
<br/><br/>
<p>
	{{ link_to('session/end', 'Log out', 'class': 'btn btn-primary btn-large btn-success') }}
</p>
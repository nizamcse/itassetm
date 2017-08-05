<script id="employee-table-template" type="text/x-handlebars-template">

    <table id="employeeTable" class="table table-striped table-bordered dataTable">
        <thead>
        <tr>
            <th>ID#</th>
            <th>Name</th>
            <th>Designation</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
        </thead>

        <tbody>
        {{#each employees}}
        <tr>
            <td>{{ this.id }}</td>
            <td>{{ this.name }}</td>
            <td>{{ this.designation }}</td>
            <td>{{ this.phone }}</td>
            <td>{{ this.email }}</td>
            <td>
                <a data-id="{{ this.id }}" data-name="{{ this.name }}" data-report="" href="#" onclick="editEmployee($(this))" class="btn btn-sm btn-info">Edit</a>
                <a data-id="{{ this.id }}" href="#" onclick="deleteEmployee($(this))" class="btn btn-sm btn-info">Delete</a>
            </td>
        </tr>
        {{/each}}
    </table>

</script>
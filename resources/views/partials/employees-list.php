<script id="employee-table-template" type="text/x-handlebars-template">

    <table id="employeeDatatable" class="table table-striped table-bordered dataTable">
        <thead>
        <tr>
            <th>ID#</th>
            <th>Name</th>
            <th>Designation</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Register</th>
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
                {{#ifEquals this.user}}
                Registered -

                    {{#ifPending this.user.is_active}}
                        <a class="btn btn-flat btn-info btn-xs" href="<?php echo route('resend-register-employee-user') ?>/{{ this.id }}">Resent</a>
                    {{/ifPending}}

                    {{#ifActive this.user.is_active}}
                        Active
                    {{/ifActive}}

                {{/ifEquals}}

                {{#ifNotEquals this.user}}
                    <a class="btn btn-flat btn-success btn-xs" href="<?php echo route('register-employee-user') ?>/{{ this.id }}">Register</a>
                {{/ifNotEquals}}
            </td>
            <td>
                <a data-id="{{ this.id }}" data-name="{{ this.name }}" data-report="" href="#" onclick="editEmployee($(this))" class="btn btn-xs btn-flat btn-info">Edit</a>
                <a data-id="{{ this.id }}" href="#" onclick="deleteEmployee($(this))" class="btn btn-xs btn-flat btn-info">Delete</a>
                {{#ifEnable this.status}}
                <a data-id="{{ this.id }}" href="#" class="btn btn-xs btn-flat btn-warning btn-disable">Disable</a>
                {{/ifEnable}}
                {{#ifDisable this.status}}
                <a data-id="{{ this.id }}" href="#" class="btn btn-xs btn-flat btn-success btn-enable">Enable</a>
                {{/ifDisable}}
            </td>
        </tr>
        {{/each}}
    </table>

</script>
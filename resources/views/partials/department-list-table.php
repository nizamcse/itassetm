<script id="built-in-helpers-template" type="text/x-handlebars-template">

    <table id="datatableN" class="table table-striped table-bordered dataTable">
        <thead>
        <tr>
            <th>ID#</th>
            <th>Department</th>
            <th>Reporting To</th>
            <th>Action</th>
        </tr>
        </thead>

        <tbody>
        {{#each departments}}
        <tr>
            <td>{{ this.id }}</td>
            <td>{{ this.name }}</td>
            <td>{{ this.reporting.name }}</td>
            <td>
                <a data-id="{{ this.id }}" data-name="{{ this.name }}" data-report="{{ this.reporting_to }}" data-report="" href="#" onclick="editDepartment($(this))" class="btn btn-xs btn-flat btn-info">Edit</a>
                <a data-id="{{ this.id }}" href="#" onclick="deleteDepartment($(this))" class="btn btn-xs btn-flat btn-info">Delete</a>
            </td>
        </tr>
        {{/each}}
    </table>

</script>
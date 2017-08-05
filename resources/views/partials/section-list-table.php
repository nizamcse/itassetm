<script id="section-data-template" type="text/x-handlebars-template">

    <table id="datatableN" class="table table-striped table-bordered dataTable">
        <thead>
        <tr>
            <th>ID#</th>
            <th>Section Name</th>
            <th>Section Supervisor</th>
            <th>Action</th>
        </tr>
        </thead>

        <tbody>
        {{#each sections}}
        <tr>
            <td>{{ this.id }}</td>
            <td>{{ this.name }}</td>
            <td></td>
            <td>
                <a data-id="{{ this.id }}" data-name="{{ this.name }}" data-report="" href="#" onclick="editSection($(this))" class="btn btn-sm btn-info">Edit</a>
                <a data-id="{{ this.id }}" href="#" onclick="deleteSection($(this))" class="btn btn-sm btn-info">Delete</a>
            </td>
        </tr>
        {{/each}}
    </table>

</script>
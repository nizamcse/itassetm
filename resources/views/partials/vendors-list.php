<script id="vendors-data-template" type="text/x-handlebars-template">

    <table id="datatableN" class="table table-striped table-bordered dataTable">
        <thead>
        <tr>
            <th>ID#</th>
            <th>Vendor Name</th>
            <th>Contact Person</th>
            <th>Phone</th>
            <th>Web</th>
            <th>Action</th>
        </tr>
        </thead>

        <tbody>
        {{#each vendors}}
        <tr>
            <td>{{ this.id }}</td>
            <td>{{ this.name }}</td>
            <td>{{ this.contact_person }}</td>
            <td>{{ this.contact_no }}</td>
            <td>{{ this.web }}</td>
            <td>
                <a data-id="{{ this.id }}" data-name="{{ this.name }}" data-supervisor="{{ this.super_visor.id }}" data-report="" href="#"  class="btn btn-sm btn-info btn-edit">Edit</a>
                <a data-id="{{ this.id }}" href="#" onclick="deleteSection($(this))" class="btn btn-sm btn-info btn-delete">Delete</a>
            </td>
        </tr>
        {{/each}}
    </table>

</script>
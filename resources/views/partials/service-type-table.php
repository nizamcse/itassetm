<script id="servicce-type-data-template" type="text/x-handlebars-template">

    <table id="datatableN" class="table table-striped table-bordered dataTable">
        <thead>
        <tr>
            <th>ID#</th>
            <th>Service Name</th>
            <th>Service Type</th>
            <th>Action</th>
        </tr>
        </thead>

        <tbody>
        {{#each service_type}}
        <tr>
            <td>{{ this.id }}</td>
            <td>{{ this.name }}</td>
            <td></td>
            <td>
                <a data-id="{{ this.id }}" data-name="{{ this.name }}" data-service-type="{{ this.service_type }}"  class="btn btn-sm btn-info btn-edit">Edit</a>
                <a data-id="{{ this.id }}" href="#" class="btn btn-sm btn-info btn-delete">Delete</a>
            </td>
        </tr>
        {{/each}}
    </table>

</script>
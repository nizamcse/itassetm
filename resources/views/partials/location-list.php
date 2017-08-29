<script id="location-data-template" type="text/x-handlebars-template">

    <table id="datatableN" class="table table-striped table-bordered dataTable">
        <thead>
        <tr>
            <th>ID#</th>
            <th>Location Name</th>
            <th>Location Parent</th>
            <th>Action</th>
        </tr>
        </thead>

        <tbody>
        {{#each locations}}
        <tr>
            <td>{{ this.id }}</td>
            <td>{{ this.name }}</td>
            <td>{{ this.parent.name }}</td>
            <td>
                <a data-id="{{ this.id }}" data-name="{{ this.name }}" data-parent="{{ this.parent.id }}" href="#" onclick="editLocation($(this))" class="btn btn-xs btn-flat btn-info">Edit</a>
                <a data-id="{{ this.id }}" href="#" onclick="deleteLocation($(this))" class="btn btn-xs btn-flat btn-info">Delete</a>
            </td>
        </tr>
        {{/each}}
    </table>

</script>
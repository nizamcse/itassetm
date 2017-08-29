<script id="manufacturer-data-template" type="text/x-handlebars-template">

    <table id="datatableN" class="table table-striped table-bordered dataTable">
        <thead>
        <tr>
            <th>ID#</th>
            <th>Manufacturer Name</th>
            <th>Action</th>
        </tr>
        </thead>

        <tbody>
        {{#each manufacturers}}
        <tr>
            <td>{{ this.id }}</td>
            <td>{{ this.name }}</td>
            <td>
                <a data-id="{{ this.id }}" data-name="{{ this.name }}"  href="#" onclick="editManufacturer($(this))" class="btn btn-xs btn-flat btn-info">Edit</a>
                <a data-id="{{ this.id }}" href="#" onclick="deleteManufacturer($(this))" class="btn btn-xs btn-flat btn-info">Delete</a>
            </td>
        </tr>
        {{/each}}
    </table>

</script>
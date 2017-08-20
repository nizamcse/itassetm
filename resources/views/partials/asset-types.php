<script id="assets-data-template" type="text/x-handlebars-template">

    <table id="assetsData" class="table table-striped table-bordered dataTable">
        <thead>
        <tr>
            <th>ID#</th>
            <th>Asset Name</th>
            <th>Asset Parent</th>
            <th>Action</th>
        </tr>
        </thead>

        <tbody>
        {{#each assets}}
        <tr>
            <td>{{ this.id }}</td>
            <td>{{ this.name }}</td>
            <td>{{ this.parent.name }}</td>
            <td>
                <a data-id="{{ this.id }}" data-parent="{{ this.parent.id }}" data-name="{{ this.name }}" data-report="" href="#" onclick="editAsset($(this))" class="btn btn-sm btn-info">Edit</a>
                <a data-id="{{ this.id }}" href="#" onclick="deleteAsset($(this))" class="btn btn-sm btn-info">Delete</a>
            </td>
        </tr>
        {{/each}}
    </table>

</script>
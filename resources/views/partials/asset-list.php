<script id="assets-list-template" type="text/x-handlebars-template">

    <table id="assetsListData" class="table table-striped table-bordered dataTable">
        <thead>
            <tr>
                <th>ID#</th>
                <th>Asset Code</th>
                <th>Asset Name</th>
                <th>Asset Type </th>
                <th>Asset Dept</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
        {{#each assets}}
        <tr>
            <td>{{ this.id }}</td>
            <td>{{ this.asset_old_cd }}</td>
            <td>{{ this.name }}</td>
            <td>{{ this.asset_types.name }}</td>
            <td>{{ this.departments.name }}</td>
            <td>
                <a data-id="{{ this.id }}" data-report="" href="#" class="btn btn-xs btn-flat btn-info btn-edit">Edit</a>
                <a data-id="{{ this.id }}" href="#" class="btn btn-xs btn-flat btn-info btn-delete">Delete</a>
            </td>
        </tr>
        {{/each}}
    </table>

</script>
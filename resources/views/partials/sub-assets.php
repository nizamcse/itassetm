<script id="sub-assets-list" type="text/x-handlebars-template">

    <table id="assetsListData" class="table table-striped table-bordered dataTable">
        <thead>
        <tr>
            <th>ID#</th>
            <th>Code</th>
            <th>Old Code</th>
            <th>Name </th>
            <th>Lifetime</th>
            <th>Retirement Date</th>
            <th>Action</th>
        </tr>
        </thead>

        <tbody>
        {{#each sub_assets}}
        <tr>
            <td>{{ this.id }}</td>
            <td>{{ this.suba_asset_cd }}</td>
            <td>{{ this.sub_asset_old_code }}</td>
            <td>{{ this.suba_name }}</td>
            <td>{{ this.suba_lifetime }} {{ this.suba_life_unit }}</td>
            <td>{{ this.suba_retainment_dt }}</td>
            <td>
                <a data-id="{{ this.id }}" data-report="" href="#" class="btn btn-xs btn-flat btn-info btn-edit">Edit</a>
                <a data-id="{{ this.id }}" href="#" class="btn btn-xs btn-flat btn-info btn-delete">Delete</a>
            </td>
        </tr>
        {{/each}}
    </table>

</script>
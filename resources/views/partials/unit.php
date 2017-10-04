<script id="unit-list-data" type="text/x-handlebars-template">
    {{#each units_of_measurement}}
    <tr>
        <td>{{ this.id }}</td>
        <td>{{ this.name }}</td>
        <td class="text-right">
            <button type="button" class="btn flat btn-xs btn-info btn-edit-unit" data-toggle="modal" data-target="#editUnits" data-id="{{ this.id }}">Edit</button>
            <button type="button" class="btn flat btn-xs btn-danger btn-delete-unit" data-id="{{ this.id }}">Delete</button>
        </td>
    </tr>
    {{/each}}
</script>
<script id="vendor-type-lists" type="text/x-handlebars-template">
    {{#each vendor_types}}
    <tr>
        <td>{{ this.id }}</td>
        <td>{{ this.name }}</td>
        <td class="text-right">
            <a href="#" class="btn flat btn-xs btn-info btn-edit-vendor-type" data-toggle="modal" data-target="#editVendorType" data-id="{{ this.id }}">Edit</a>
            <a href="#" class="btn flat btn-xs btn-danger btn-delete-vendor-type" data-id="{{ this.id }}">Delete</a>
        </td>
    </tr>
    {{/each}}
</script>
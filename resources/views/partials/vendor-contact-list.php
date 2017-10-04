<script id="vendor-contact-lists" type="text/x-handlebars-template">
    {{#each vendor_contacts}}
    <tr>
        <td>{{ this.id }}</td>
        <td>{{ this.contact_person }}</td>
        <td>{{ this.contact_number }}</td>
        <td>{{ this.address }}</td>
        <td class="text-right">
            <a href="#" class="btn flat btn-xs btn-info btn-edit-vendor-contact" data-toggle="modal" data-target="#editVendorContact" data-id="{{ this.id }}">Edit</a>
            <a href="#" class="btn flat btn-xs btn-danger btn-delete-vendor-contact" data-id="{{ this.id }}">Delete</a>
        </td>
    </tr>
    {{/each}}
</script>
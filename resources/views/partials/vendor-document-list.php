<script id="vendor-document-lists" type="text/x-handlebars-template">
    {{#each vendor_documents}}
    <tr>
        <td>{{ this.id }}</td>
        <td>{{ this.title }}</td>
        <td><a href="#">{{ this.document }}</a></td>
        <td>{{ this.address }}</td>
        <td class="text-right">
            <a target="_blank" href="<?php echo asset('public/documents/vendor') ?>/{{ this.document }}" class="btn flat btn-xs btn-danger btn-delete-vendor-document" data-id="{{ this.id }}">Delete</a>
        </td>
    </tr>
    {{/each}}
</script>
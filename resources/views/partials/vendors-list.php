<script id="vendors-data-template" type="text/x-handlebars-template">

    <table id="datatableN" class="table table-striped table-bordered dataTable">
        <thead>
        <tr>
            <th>ID#</th>
            <th>Vendor Name</th>
            <th>Contact Person</th>
            <th>Phone</th>
            <th>Web</th>
            <th>Action</th>
        </tr>
        </thead>

        <tbody>
        {{#each vendors}}
        <tr>
            <td>{{ this.id }}</td>
            <td><a href="<?php echo route('vendor-contacts');  ?>/{{ this.id }}">{{ this.name }}</a></td>
            <td>{{ this.contact_person }}</td>
            <td>{{ this.contact_no }}</td>
            <td>{{ this.web }}</td>
            <td>
                <a data-id="{{ this.id }}" data-name="{{ this.name }}" data-supervisor="{{ this.super_visor.id }}" data-report="" href="#"  class="btn btn-xs btn-flat btn-info btn-edit">Edit</a>
                <a data-id="{{ this.id }}" href="#" onclick="deleteSection($(this))" class="btn btn-xs btn-flat btn-info btn-delete">Delete</a>
                {{#ifEnable this.status}}
                    <a data-id="{{ this.id }}" href="#" class="btn btn-xs btn-flat btn-warning btn-disable">Disable</a>
                {{/ifEnable}}
                {{#ifDisable this.status}}
                    <a data-id="{{ this.id }}" href="#" class="btn btn-xs btn-flat btn-success btn-enable">Enable</a>
                {{/ifDisable}}
            </td>
        </tr>
        {{/each}}
    </table>

</script>
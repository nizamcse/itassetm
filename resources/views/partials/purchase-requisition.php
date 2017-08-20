<script id="purchase-requisition-list" type="text/x-handlebars-template">

    <table id="purchaseRequisitionDataTable" class="table table-striped table-bordered dataTable">
        <thead>
        <tr>
            <th>ID#</th>
            <th>Purchase Requisition Type</th>
            <th>Particulars</th>
            <th class="text-right">Action</th>
        </tr>
        </thead>

        <tbody>
        {{#each purchase_requisitions}}
        <tr>
            <td>{{ this.id }}</td>
            <td>{{ this.budget_type.budget_type_name }}</td>
            <td>{{ this.particulars }}</td>
            <td class="text-right">
                <a data-id="{{ this.id }}"  href="#" class="btn btn-sm btn-info btn-edit">Edit</a>
                <a data-id="{{ this.id }}" href="#" class="btn btn-sm btn-info btn-delete">Delete</a>
            </td>
        </tr>
        {{/each}}
    </table>

</script>
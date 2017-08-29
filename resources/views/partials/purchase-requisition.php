<script id="purchase-requisition-list" type="text/x-handlebars-template">

    <table id="purchaseRequisitionDataTable" class="table table-striped table-bordered dataTable">
        <thead>
        <tr>
            <th>ID#</th>
            <th>Req Type</th>
            <th>Particulars</th>
            <th>Asset</th>
            <th>Employee</th>
            <th>QTY</th>
            <th>Approx Price</th>
            <th class="text-right">Action</th>
        </tr>
        </thead>

        <tbody>
        {{#each purchase_requisitions}}
            {{#each purchase_requisition_details}}
                <tr>
                    <td>{{ ../budget_type.id }}</td>
                    <td>{{ ../budget_type.budget_type_name }}</td>
                    <td>{{ ../particulars }}</td>
                    <td>{{ this.asset.name }}</td>
                    <td>{{ this.asset.employee.name }}</td>
                    <td>{{ this.quantity }}</td>
                    <td>{{ this.approx_price }}</td>
                    <td class="text-right">
                        <a data-id="{{ ../id }}"  href="#" class="btn btn-xs btn-flat btn-info btn-edit">Edit</a>
                        <a data-id="{{ ../id }}" href="#" class="btn btn-xs btn-flat btn-info btn-delete">Delete</a>
                    </td>
                </tr>
            {{/each}}
        {{/each}}
    </table>

</script>
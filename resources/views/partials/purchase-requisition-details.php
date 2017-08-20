<script id="purchase-requisition-details-list" type="text/x-handlebars-template">

    <table id="purchaseRequisitionDetailsDataTable" class="table table-striped table-bordered dataTable">
        <thead>
        <tr>
            <th>ID#</th>
            <th>Asset Name</th>
            <th>Employee Name</th>
            <th>Quantity</th>
            <th>Approximate Price</th>
            <th class="text-right">Action</th>
        </tr>
        </thead>

        <tbody>
        {{#each purchase_requisition_details}}
        <tr>
            <td>{{ this.id }}</td>
            <td>{{ this.asset.name }}</td>
            <td>{{ this.asset.employee.name }}</td>
            <td>{{ this.quantity }}</td>
            <td>{{ this.approx_price }}</td>
            <td class="text-right">
                <a data-id="{{ this.id }}"  href="#" class="btn btn-sm btn-info btn-edit">Edit</a>
                <a data-id="{{ this.id }}" href="#" class="btn btn-sm btn-info btn-delete">Delete</a>
            </td>
        </tr>
        {{/each}}
    </table>

</script>
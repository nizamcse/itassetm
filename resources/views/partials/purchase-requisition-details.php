<script id="purchase-requisition-details-list" type="text/x-handlebars-template">

    <table id="purchaseRequisitionDetailsDataTable" class="table table-striped table-bordered dataTable">
        <thead>
        <tr>
            <th>ID#</th>
            <th>Asset Name</th>
            <th>Quantity</th>
            <th>Approximate Price</th>
            {{#ifEditable pr_req_details.info.status}}
            <th class="text-right">Action</th>
            {{/ifEditable}}
        </tr>
        </thead>

        <tbody>
        {{#each pr_req_details.data}}
        <tr>
            <td>{{ this.id }}</td>
            <td>{{ this.asset.name }}</td>
            <td>{{ this.quantity }}</td>
            <td>{{ this.approx_price }}</td>
            {{#ifEditable this.purchase_requisition.status}}
            <td class="text-right">
                <a href="#" class="btn flat btn-xs btn-info btn-edit-pr-detail" data-toggle="modal" data-target="#editPrDetails" data-id="{{ this.id }}">Edit</a>
                <a href="#" class="btn flat btn-xs btn-danger btn-delete-pr-detail" data-id="{{ this.id }}">Delete</a>
            </td>
            {{/ifEditable}}
        </tr>
        {{/each}}
    </table>

</script>
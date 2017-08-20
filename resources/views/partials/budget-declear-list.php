<script id="budget-declear-list" type="text/x-handlebars-template">

    <table id="budgetDeclearListData" class="table table-striped table-bordered dataTable">
        <thead>
        <tr>
            <th>ID#</th>
            <th>Type</th>
            <th>Head</th>
            <th>Particular</th>
            <th>Manufacturer</th>
            <th>Supplier</th>
            <th>USD</th>
            <th>BDT</th>
            <th>QTY</th>
            <th>UOM </th>
            <th>Action</th>
        </tr>
        </thead>

        <tbody>
        {{#each yearly_budgets}}
        <tr>
            <td>{{ this.id }}</td>
            <td>{{ this.budget_type.budget_type_name }}</td>
            <td>{{ this.budget_head.name }}</td>
            <td>{{ this.budget_particulars }}</td>
            <td>{{ this.manufacturer.name }}</td>
            <td>{{ this.vendor.name }}</td>
            <td>{{ this.usd_amount }}</td>
            <td>{{ this.bdt_amount }}</td>
            <td>{{ this.quantity }}</td>
            <td>{{ this.unit.name }}</td>
            <td>
                <a data-id="{{ this.id }}"  href="#" class="btn btn-sm btn-info btn-edit">Edit</a>
                <a data-id="{{ this.id }}" href="#" class="btn btn-sm btn-info btn-delete">Delete</a>
            </td>
        </tr>
        {{/each}}
    </table>

</script>
<script id="budget-type-list" type="text/x-handlebars-template">

    <table id="budgetTypeApprovalData" class="table table-striped table-bordered dataTable">
        <thead>
        <tr>
            <th>ID#</th>
            <th>Employee Name</th>
            <th>Employees Approval Level </th>
            <th class="text-right">Action</th>
        </tr>
        </thead>

        <tbody>
        {{#each budget_types_employee}}
        <tr>
            <td>{{ this.id }}</td>
            <td>{{ this.employee.name }}</td>
            <td>{{ this.employee_order }}</td>
            <td class="text-right">
                <a data-id="{{ this.id }}" data-name="{{ this.employee.name }}" data-emp="{{ this.employee.id }}" data-order="{{ this.employee_order }}"  href="#" class="btn btn-sm btn-info btn-edit">Edit</a>
                <a data-id="{{ this.id }}" data-budget="{{ this.budget_type }}" href="#" class="btn btn-sm btn-info btn-delete">Delete</a>
            </td>
        </tr>
        {{/each}}
    </table>

</script>
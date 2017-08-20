<script id="budget-type-list" type="text/x-handlebars-template">

    <table id="budgetTypetData" class="table table-striped table-bordered dataTable">
        <thead>
        <tr>
            <th>ID#</th>
            <th>Budget Type Name</th>
            <th>Budget Type Year</th>
            <th>Budget Type Information</th>
            <th>Level Of Approval </th>
            <th class="text-right">Action</th>
        </tr>
        </thead>

        <tbody>
        {{#each budget_types}}
        <tr>
            <td>{{ this.id }}</td>
            <td>{{ this.budget_type_name }}</td>
            <td>{{ this.budget_type_year }}</td>
            <td>
                {{#ifEquals this.type_info 'budget'}}
                BUDGET
                {{/ifEquals}}
                {{#ifEquals this.type_info 'purchase_requisition'}}
                PURCHASE REQUISITION
                {{/ifEquals}}
            </td>
            <td>{{ this.budget_type_level_apv }}</td>
            <td class="text-right">
                <a data-id="{{ this.id }}"  href="#" class="btn btn-sm btn-info btn-edit">Edit</a>
                <a data-id="{{ this.id }}" href="#" class="btn btn-sm btn-info btn-delete">Delete</a>
            </td>
        </tr>
        {{/each}}
    </table>

</script>
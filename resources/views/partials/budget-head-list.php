<script id="budget-head-list" type="text/x-handlebars-template">

    <table id="budgetHeadListData" class="table table-striped table-bordered dataTable">
        <thead>
        <tr>
            <th>ID#</th>
            <th>Budget Head Name</th>
            <th>Budget Head Parent</th>
            <th>Budget Head Level </th>
            <th class="text-right">Action</th>
        </tr>
        </thead>

        <tbody>
        {{#each budget_heades}}
        <tr>
            <td>{{ this.id }}</td>
            <td>{{ this.name }}</td>
            <td>{{ this.parent.name }}</td>
            <td>{{ this.bhead_level }}</td>
            <td class="text-right">
                <a data-id="{{ this.id }}"  href="#" class="btn btn-sm btn-info btn-edit">Edit</a>
                <a data-id="{{ this.id }}" href="#" class="btn btn-sm btn-info btn-delete">Delete</a>
            </td>
        </tr>
        {{/each}}
    </table>

</script>

<script type="text/javascript">
    $(document).ready(function(){

    });
    jQuery(window).load(function () {


        setTimeout(function () {
            //alert('page is loaded and 1 minute has passed');

        }, 30000);

    });
</script>
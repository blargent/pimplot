<script type="text/template" data-grid="standard" data-template="results">

    <% _.each(results, function(r) { %>

    <tr>
        <td><%= r.lot_num %></td>
        <td><%= r.lot_name %></td>
        <td><%= r.statusname %></td>
        <td><%= r.critical_issue_flag %></td>
        <td><%= r.buildlabel %></td>
        <td><%= r.notes %></td>
        <td><%= r.builder_date %></td>
        <td><%= r.adjust_date_to %></td>
        <td><%= r.created_at %></td>
        <td><%= r.verify_no_update %></td>
        <td><%= r.username %></td>
    </tr>

	<% }); %>

</script>

<!--        <td><%= r.lot_num %></td>-->
<!--        <td><%= r.lot_name %></td>-->
<!--        <td><%= r.statusname %></td>-->
<!--        <td><%= r.critical_issue_flag %></td>-->
<!--        <td><%= r.buildlabel %></td>-->
<!--        <td><%= r.notes %></td>-->
<!--        <td><%= r.builder_date %></td>-->
<!--        <td><%= r.adjust_date_to %></td>-->
<!--        <td><%= r.created_at %></td>-->
<!--        <td><%= r.verify_no_update %></td>-->
<!--        <td><%= r.username %></td>-->
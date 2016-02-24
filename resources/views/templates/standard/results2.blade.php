<script type="text/template" data-grid="standard" data-template="results">

    <% _.each(results, function(r) { %>

    <tr>
        <td>
            <%= r.info.lot_num %></td>
            <td><%= r.info.lot_name %></td>
            <td><%= r.statusname %></td>
            <td><%= r.info.critical_issue_flag %></td>
            <td><%= r.buildtype %></td>
            <td><%= r.info.notes %></td>
            <td><%= r.info.builder_date %></td>
            <td><%= r.info.adjust_date_to %></td>
            <td><%= r.info.created_at %></td>
            <td><%= r.info.verify_no_update %></td>
            <td><%= r.username %></td>
		</tr>

	<% }); %>

</script>
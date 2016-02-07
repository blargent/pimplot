<script type="text/template" data-grid="standard" data-template="results">

    <% _.each(results, function(r) { %>

    <tr>
        <td>
			<%= r.lot_num %></td>
			<td><%= r.status.status_label %></td>
			<td><%= r.build_type_id %></td>
			<td><%= r.critical_issue_flag %></td>
			<td><%= r.verify_no_update %></td>
			<td><%= r.notes %></td>
			<td><%= r.created_at %></td>
			<td><%= r.user.name %></td>
		</tr>

	<% }); %>

</script>
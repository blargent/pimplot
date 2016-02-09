<script type="text/template" data-grid="standard" data-template="results">

    <% _.each(results, function(r) { %>

    <tr>
        <td>
			<%= r.lot_num %></td>
			<td><%= r.lot_name %></td>
			<td><%= r.statusdef.name %></td>
			<td><%= r.critical_issue_flag %></td>
            <td><%= r.buildtype.label %></td>
			<td><%= r.notes %></td>
			<td><%= r.builder_date %></td>
			<td><%= r.adjust_date_to %></td>
			<td><%= r.created_at %></td>
   			<td><%= r.verify_no_update %></td>
            <td><%= r.user.name %></td>
		</tr>

	<% }); %>

</script>

<!--<td><%= r.buildtype.label %></td>-->
<!--<td><%= r.user.name %></td>-->
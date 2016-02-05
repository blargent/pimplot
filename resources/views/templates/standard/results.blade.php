<script type="text/template" data-grid="standard" data-template="results">

    <% _.each(results, function(r) { %>

    <tr>
        <td><%= r.id %></td>
			<td><%= r.lot_num %></td>
			<td><%= r.status_id %></td>
			<td><%= r.notes %></td>
		</tr>

	<% }); %>

</script>
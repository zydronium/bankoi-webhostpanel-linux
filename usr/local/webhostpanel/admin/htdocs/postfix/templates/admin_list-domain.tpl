<center>
<form name="overview" method="post">
<select name="fUsername">
<?php
for ($i = 0; $i < sizeof ($list_admins); $i++)
{
   if ($fUsername == $list_admins[$i])
   {
      print "<option value=\"" . $list_admins[$i] . "\" selected>" . $list_admins[$i] . "</option>\n";
   }
   else
  {
      print "<option value=\"" . $list_admins[$i] . "\">" . $list_admins[$i] . "</option>\n";
   }
}
?>
</select>
<input type="submit" name="submit" value="<?php print $PALANG['pOverview_button']; ?>" />
</form>
<p />
<?php 
if (sizeof ($list_domains) > 0)
{
   print "<center>\n";
   print "<table class=\"auto\" border=\"1\">\n";
   print "   <tr class=\"header\">\n";
   print "      <td>" . $PALANG['pAdminList_domain_domain'] . "</td>\n";
   print "      <td>" . $PALANG['pAdminList_domain_description'] . "</td>\n";
   print "      <td>" . $PALANG['pAdminList_domain_aliases'] . "</td>\n";
   print "      <td>" . $PALANG['pAdminList_domain_mailboxes'] . "</td>\n";
   if ($CONF['quota'] == 'YES') print "      <td>" . $PALANG['pAdminList_domain_maxquota'] . "</td>\n";
   print "      <td>" . $PALANG['pAdminList_domain_modified'] . "</td>\n";
   print "      <td>" . $PALANG['pAdminList_domain_active'] . "</td>\n";
   print "      <td colspan=\"2\">&nbsp;</td>\n";
   print "   </tr>\n";

   for ($i = 0; $i < sizeof ($list_domains); $i++)
   {
		print "<tr onMouseOver=\"this.bgColor = '#dfdfdf'\" onMouseOut =\"this.bgColor = '#ffffff'\" bgcolor=\"#ffffff\">";
		print "<td><a href=\"list-virtual.php?domain=" . $list_domains[$i] . "\">" . $list_domains[$i] . "</a></td>";
		print "<td>" . $domain_properties[$i]['description'] . "</td>";
		print "<td>" . $domain_properties[$i]['alias_count'] . " / " . $domain_properties[$i]['aliases'] . "</td>";
		print "<td>" . $domain_properties[$i]['mailbox_count'] . " / " . $domain_properties[$i]['mailboxes'] . "</td>";
		if ($CONF['quota'] == 'YES') print "<td>" . $domain_properties[$i]['maxquota'] . "</td>";
		print "<td>" . $domain_properties[$i]['modified'] . "</td>";
      $active = ($domain_properties[$i]['active'] == 1) ? $PALANG['YES'] : $PALANG['NO'];
		print "<td><a href=\"edit-active-domain.php?domain=" . $list_domains[$i] . "\">" . $active . "</a></td>";
		print "<td><a href=\"edit-domain.php?domain=" . $list_domains[$i] . "\">" . $PALANG['edit'] . "</a></td>";
		print "<td><a href=\"delete.php?table=domain&where=domain&delete=" . $list_domains[$i] . "\" onclick=\"return confirm ('" . $PALANG['confirm_domain'] . "')\">" . $PALANG['del'] . "</a></td>";
		print "</tr>\n";
   }

   print "</table>\n";
   print "</center>\n";
   print "<p />\n";
}
?>

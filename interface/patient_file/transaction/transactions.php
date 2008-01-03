<?php
include_once("../../globals.php");
include_once("$srcdir/transactions.inc");
?>
<html>
<head>

<link rel=stylesheet href="<?echo $css_header;?>" type="text/css">

</head>
<body <?echo $bottom_bg_line;?> topmargin='0' rightmargin='0' leftmargin='2'
 bottommargin='0' marginwidth='2' marginheight='0'>

<a href="add_transaction.php" onclick="top.restoreSession()">
<font class="title"><? xl('Patient Transactions','e'); ?></font>
<font class='more'>(Add Transaction)</font></a>

<br>
<table>

<?php
if ($result = getTransByPid($pid)) {
  foreach ($result as $iter) {
    $transid = $iter['id'];
    $elink = "<a href='add_transaction.php?transid=$transid' " .
      "onclick='top.restoreSession()' title='Click to edit'>";
    $plink = "<a href='print_referral.php?transid=$transid' target='_blank' " .
      "onclick='top.restoreSession()' title='Click to print'>";
    if (getdate() == strtotime($iter['date'])) {
      $date_string = "Today, " . date( "D F dS" ,strtotime($iter['date']));
    } else {
      $date_string = date( "D F dS" ,strtotime($iter['date']));
    }
    echo "<tr><td class='bold'>$elink" . $date_string . " (" . $iter['user'] . ")</a></td>";
    echo "<td class='text'>";
    if ($iter['title'] == 'Referral') {
      echo $plink . $iter['title'] . "</a>";
    } else {
      echo $iter['title'];
    }
    echo "</td>";
    echo "<td class='text'>" . stripslashes($iter['body']) . "</td></tr>\n";
  }
}
?>

</table>

</body>
</html>
